@styles('vendor', [
    asset(mix('vendors/css/extensions/jquery.contextMenu.min.css')),
    asset(mix('vendors/css/file-uploaders/dropzone.min.css'))
])
@styles('page', [
    asset(mix('css/base/plugins/extensions/ext-component-context-menu.css')),
    asset(mix('css/base/pages/app-file-manager.css')),
    asset(mix('css/base/plugins/forms/form-file-uploader.css'))
])
@scripts('vendor', [
    asset(mix('vendors/js/extensions/polyfill.min.js')),
    asset(mix('vendors/js/extensions/jquery.contextMenu.min.js')),
    asset(mix('vendors/js/extensions/jquery.ui.position.min.js')),
    asset(mix('vendors/js/file-uploaders/dropzone.min.js'))
])
@scripts('page', asset(mix('js/scripts/extensions/ext-component-clipboard.js')))
@push('page-scripts')
    <script type="text/javascript">
        Dropzone.autoDiscover = false;

        $(function () {
            const options = {!! json_encode($options) !!};
            let folders = [],
                files = [],
                folderCount = 0,
                fileCount = 0,
                selectedMedias = [],
                currentFolder = options.folder,
                currentFile = null,
                breadcrumbs = []
            ;
            const $btnUpload = $('.btn-upload'),
                $btnCreateFolder = $('.btn-create-folder'),
                $btnSelectAll = $('.btn-select-all'),
                $btnUnSelectAll = $('.btn-unselect-all'),
                $btnDelete = $('.btn-delete'),
                $btnReload = $('.btn-reload'),
                $btnView = $('input[name="view-btn-radio"]'),
                $btnYes = $('.card-footer .btn-primary'),
                $btnClose = $('.card-footer .btn-outline-secondary'),
                $uploadModal = new bootstrap.Modal(document.getElementById('uploadModal')),
                $createFolderModal = new bootstrap.Modal(document.getElementById('createFolderModal')),
                $createFolderModalInput = $('#createFolderModal .modal-body input'),
                $createFolderModalButton = $('#createFolderModal .modal-footer .btn-primary'),
                $renameModal = new bootstrap.Modal(document.getElementById('renameModal')),
                $renameModalLabel = $('#renameModal .modal-header .media-name'),
                $renameModalInput = $('#renameModal .modal-body input'),
                $renameModalButton = $('#renameModal .modal-footer .btn-primary'),
                $urlModal = new bootstrap.Modal(document.getElementById('urlModal')),
                $urlModalInput = $('#urlModal .modal-body input'),
                $urlModalButton = $('#urlModal .modal-body button'),
                $infoModal = new bootstrap.Modal(document.getElementById('infoModal')),
                $infoModalLabel = $('#infoModal .modal-title'),
                $infoModalMediaType = $('#infoModal .media-type'),
                $infoModalMediaSize = $('#infoModal .media-size'),
                $infoModalMediaLocation = $('#infoModal .media-location'),
                $infoModalMediaOwner = $('#infoModal .media-owner'),
                $infoModalMediaModified = $('#infoModal .media-modified'),
                $infoModalMediaCreated = $('#infoModal .media-created'),
                $viewContainer = $('.media-content-body .view-container'),
                $viewLoading = $('.media-content-body .view-loading'),
                $breadcrumb = $('.media-manager .breadcrumb')
            ;

            const selectorNames = {
                tooltip: '.tooltip',
                breadcrumb: '.media-manager .breadcrumb a',
                mediaItem: '.media-item',
                mediaItemFolder: '.media-item.folder',
                mediaItemCheck: '.media-item .form-check input',
                mediaItemGrid: '.view-container:not(.list-view) .media-item',
                mediaItemDropdown: '.media-item .dropdown',
                mediaSelectedCount: '.media-selected-count',
                mediaSectionTitle: '.media-content-body .view-container .media-section-title'
            };

            const listIcons = {
                preview: 'fa fa-eye',
                url: 'fa fa-link',
                rename: 'fa fa-edit',
                move: 'fa fa-cut',
                delete: 'fa fa-trash-alt',
                info: 'fa fa-info',
            };

            const menuIcon = (opt, $itemElement, itemKey, item) => {
                if (listIcons[itemKey]) {
                    $itemElement.html(`<i class="${listIcons[itemKey]}"></i> ${item.name}`);
                }
            };

            const menuVisibleFile = (key, opt) => {
                const $media = opt.trigger==='left'?opt.$trigger.parents(selectorNames.mediaItem):opt.$trigger;
                return files[parseInt($media.data('id'))] !== undefined;
            };
            const menuVisibleKey = (key, opt) => {
                return options[key];
            };

            let menuItems = {
                preview: {
                    name: '{{ __('Preview') }}',
                    icon: menuIcon,
                    visible: menuVisibleFile
                },
                url: {
                    name: '{{ __('Show Url') }}',
                    icon: menuIcon,
                    visible: menuVisibleFile
                },
                info: {
                    name: '{{ __('Info') }}',
                    icon: menuIcon,
                    visible: menuVisibleKey
                },
                sep1: "---------",
                rename: {
                    name: '{{ __('Rename') }}',
                    icon: menuIcon,
                    visible: menuVisibleKey
                },
                move: {
                    name: '{{ __('Move') }}',
                    icon: menuIcon,
                    visible: menuVisibleKey
                },
                delete: {
                    name: '{{ __('Delete') }}',
                    icon: menuIcon,
                    visible: menuVisibleKey
                }
            };

            const menuCallback = (key, opt) => {
                const $media = opt.trigger==='left'?opt.$trigger.parents(selectorNames.mediaItem):opt.$trigger;
                currentFile = parseInt($media.data('id'));
                const media = folders[currentFile] ?? files[currentFile];

                switch (key) {
                    case 'preview':
                        break;
                    case 'url':
                        $urlModal.show();
                        $urlModalInput.val(files[currentFile].url);
                        $urlModalButton.text('{{__('Copy')}}');
                        break;
                    case 'info':
                        let locations = ['Root'];
                        $.each(breadcrumbs, function (index, breadcrumb) {
                            locations.push(breadcrumb.name);
                        });

                        $infoModal.show();
                        $infoModalLabel.text(media.name);
                        $infoModalMediaType.text('Folder');
                        $infoModalMediaSize.text(calcSize(media.size));
                        $infoModalMediaLocation.text(locations.join(' > '));
                        $infoModalMediaOwner.text(media.owner.full_name);
                        $infoModalMediaModified.text(formatTime(media.updated_at));
                        $infoModalMediaCreated.text(formatTime(media.created_at));
                        break;
                    case 'rename':
                        $renameModal.show();
                        $renameModalLabel.text(media.name);
                        $renameModalInput.val(media.name);
                        break;
                    case 'move':
                        break;
                    case 'delete':
                        confirmAction(function () {
                            $.ajax({
                                url: '{{ route('admin.media.delete', '') }}/' + currentFile,
                                type: 'DELETE',
                                dataType: 'json'
                            }).done(function(response) {
                                if(files[currentFile]) {
                                    delete files[currentFile];
                                    fileCount --;
                                    $(selectorNames.mediaSectionTitle).last().html(`${fileCount} {{__('Files')}}`);
                                } else {
                                    delete folders[currentFile];
                                    folderCount --;
                                    $(selectorNames.mediaSectionTitle).first().html(`${folderCount} {{__('Folders')}}`);
                                }
                                $(`.media-item[data-id=${currentFile}]`).remove();
                            });
                        });
                        break;
                }
            };

            const calcSize = (size) => {
                let i = -1;
                const byteUnits = [' kB', ' MB', ' GB', ' TB', 'PB', 'EB', 'ZB', 'YB'];
                do {
                    size = size / 1024;
                    i++;
                } while (size > 1024);

                return Math.max(size, 0).toFixed(1) + byteUnits[i];
            };

            const formatTime = (time) => {
              return (new Date(time)).toLocaleString()
            }

            const mediaItemTemplate = (media) => {

                const fileSize = calcSize(media.size),
                    lastModify = formatTime(media.updated_at),
                    mediaIcons = (file_name) => {
                        const ext = file_name.split('.').pop();
                        return `{{ asset('images/icons') }}/${ext}.png`;
                    }
                ;
                let icon = '<i class="far fa-folder"></i>',
                    thumbImage = '',
                    type = media.type
                ;

                if (media.type === 'file') {
                    icon = `<img src="${mediaIcons(media.file_name)}" alt="file-icon">`;
                    if (media.thumb) {
                        thumbImage = `style="background-image: url('${media.thumb}');"`;
                        type = `${type} image`;
                    }
                }

                return `<div class="card media-item ${type}" data-id="${media.id}">
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" />
                    </div>
                    <div class="card-img-top" ${thumbImage}>
                        <div class="dropdown">
                            <i class="fa fa-ellipsis-v toggle-dropdown mt-n25"></i>
                        </div>
                        <div class="d-flex align-items-center justify-content-center w-100">${icon}</div>
                    </div>
                    <div class="card-body">
                        <div class="content-wrapper">
                            <p class="card-text file-name mb-0">${media.name}</p>
                            <p class="card-text file-size mb-0">${fileSize}</p>
                            <p class="card-text file-date">${lastModify}</p>
                        </div>
                    </div>
                </div>`;
            };

            const loadMedias = () => {
                $viewLoading.show();
                $viewContainer.hide();
                $.ajax({
                    url: '{{ route('admin.media.query') }}',
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        folder_id: currentFolder,
                        type: options.type
                    }
                }).done(function(response) {
                    folders = [];
                    files = [];
                    selectedMedias = [];
                    $(selectorNames.mediaItem).remove();
                    $viewLoading.hide();
                    $viewContainer.show();
                    folderCount = response.data.folder?response.data.folder.length:0;
                    fileCount = response.data.file?response.data.file.length:0;
                    $(selectorNames.mediaSectionTitle).first().html(`${folderCount} {{__('Folders')}}`);
                    $(selectorNames.mediaSectionTitle).last().html(`${fileCount} {{__('Files')}}`);
                    if (response.data.folder) {
                        $.each(response.data.folder, function (index, folder) {
                            folders[folder.id] = folder;
                            $(mediaItemTemplate(folder)).appendTo($viewContainer.first());
                        });
                    }
                    if (response.data.file) {
                        $.each(response.data.file, function (index, file) {
                            files[file.id] = file;
                            $(mediaItemTemplate(file)).appendTo($viewContainer.last());
                        });
                    }
                    if (options.upload) {
                        $btnUpload.prop('disabled', false);
                    }
                    if (options.createFolder) {
                        $btnCreateFolder.prop('disabled', false);
                    }
                    $btnReload.prop('disabled', false);
                    if (!options.single) {
                        $btnSelectAll.prop('disabled', false);
                    } else {
                        $btnSelectAll.prop('disabled', true);
                    }
                });
            };

            const initSelectUI = () => {
                $(selectorNames.mediaSelectedCount).text(selectedMedias.length);

                if (selectedMedias.length < fileCount + folderCount && !options.single) {
                    $btnSelectAll.prop('disabled', false);
                } else {
                    $btnSelectAll.prop('disabled', true);
                }
                if (selectedMedias.length > 0) {
                    $btnUnSelectAll.prop('disabled', false);
                    $btnYes.prop('disabled', false);
                    if (options.delete) {
                        $btnDelete.prop('disabled', false);
                    }
                } else {
                    $btnUnSelectAll.prop('disabled', true);
                    $btnYes.prop('disabled', true);
                    $btnDelete.prop('disabled', true);
                }
            };

            const initBreadcrumb = () => {
                $breadcrumb.empty();
                if (breadcrumbs.length === 0) {
                    $breadcrumb.append('<li class="breadcrumb-item"><i class="fa fa-home"></i></li>');
                } else {
                    $breadcrumb.append('<li class="breadcrumb-item"><a href="#"><i class="fa fa-home"></i></a></li>');
                    $.each(breadcrumbs, function (index, breadcrumb) {
                        if (index+1 < breadcrumbs.length) {
                            $breadcrumb.append(`<li class="breadcrumb-item"><a href="#" data-index="${index}">${breadcrumb.name}</a></li>`);
                        } else {
                            $breadcrumb.append(`<li class="breadcrumb-item">${breadcrumb.name}</li>`);
                        }
                    });
                }
            };

            $.contextMenu({
                selector: selectorNames.mediaItemGrid,
                callback: menuCallback,
                items: menuItems
            });
            $.contextMenu({
                selector: selectorNames.mediaItemDropdown,
                trigger: "left",
                callback: menuCallback,
                items: menuItems
            });

            $btnView.on('change', function (e) {
                const viewType = $(this).val();

                if (viewType === 'grid') {
                    $viewContainer.removeClass('list-view');
                }
                else {
                    $viewContainer.addClass('list-view');
                }
            });

            $(document).on('change', selectorNames.mediaItemCheck, function(){
                let $media = $(this).parents(selectorNames.mediaItem);
                const mediaId = $media.data('id');
                if ( $(this).prop('checked')) {
                    if (options.single) {
                        selectedMedias = [];
                        $(selectorNames.mediaItem).removeClass('selected');
                        $(selectorNames.mediaItemCheck).not(this).prop('checked', false);
                    }
                    $media.addClass('selected');
                    selectedMedias.push(mediaId);
                }
                else {
                    $media.removeClass('selected');
                    selectedMedias = selectedMedias.filter(e => e !== mediaId);
                }
                initSelectUI();
            });

            $(document).on('click', selectorNames.breadcrumb, function(){
                const index = $(this).data('index');
                if (index !== undefined) {
                    currentFolder = breadcrumbs[index].id;
                    breadcrumbs = breadcrumbs.slice(0, index + 1);
                } else {
                    currentFolder = options.folder;
                    breadcrumbs = [];
                }
                initBreadcrumb();
                loadMedias();
            });

            $(document).on('dblclick', selectorNames.mediaItemFolder, function(){
                const id = $(this).data('id');
                currentFolder = id;
                breadcrumbs.push({
                    id: id,
                    name: folders[id].name
                });
                initBreadcrumb();
                loadMedias();
            });

            $btnUpload.on('click', function (e) {
                $(selectorNames.tooltip).remove();
                $uploadModal.show();
            });

            $btnCreateFolder.on('click', function (e) {
                $(selectorNames.tooltip).remove();
                $createFolderModalInput.val('{{ __('New Folder') }}');
                $createFolderModal.show();
            });

            $btnSelectAll.on('click', function (e) {
                selectedMedias = [];
                selectedMedias = selectedMedias.concat(Object.keys(folders).map(id => parseInt(id)));
                selectedMedias = selectedMedias.concat(Object.keys(files).map(id => parseInt(id)));
                $(selectorNames.mediaItem).addClass('selected');
                $(selectorNames.mediaItemCheck).prop('checked', true);
                $(selectorNames.tooltip).remove();
                initSelectUI();
            });

            $btnUnSelectAll.on('click', function (e) {
                selectedMedias = [];
                $(selectorNames.mediaItem).removeClass('selected');
                $(selectorNames.mediaItemCheck).prop('checked', false);
                $(selectorNames.tooltip).remove();
                initSelectUI();
            });

            $btnDelete.on('click', function (e) {
                $(selectorNames.tooltip).remove();
                confirmAction(function () {
                    $.ajax({
                        url: '{{ route('admin.media.deletes') }}',
                        type: 'DELETE',
                        dataType: 'json',
                        data: {ids: selectedMedias},
                    }).done(function(response) {
                        $.each(selectedMedias, function (index, id) {
                            if(files[id]) {
                                delete files[id];
                                fileCount --;
                            } else {
                                delete folders[id];
                                folderCount --;
                            }
                            $(`.media-item[data-id=${id}]`).remove();
                        })
                        $(selectorNames.mediaSectionTitle).last().html(`${fileCount} Files`);
                        $(selectorNames.mediaSectionTitle).first().html(`${folderCount} Folders`);
                    });
                });
            });

            $btnReload.on('click', function (e) {
                $(selectorNames.tooltip).remove();
                loadMedias();
            });

            $urlModalButton.on('click', function (e) {
                if (navigator && navigator.userAgent.match(/ipad|ipod|iphone/i)) {
                    var el = $urlModalInput.get(0);
                    var editable = el.contentEditable;
                    var readOnly = el.readOnly;
                    el.contentEditable = 'true';
                    el.readOnly = 'false';
                    var range = document.createRange();
                    range.selectNodeContents(el);
                    var sel = window.getSelection();
                    sel.removeAllRanges();
                    sel.addRange(range);
                    el.setSelectionRange(0, 999999);
                    el.contentEditable = editable;
                    el.readOnly = readOnly;
                } else {
                    $urlModalInput.select();
                }
                document.execCommand('copy');
                $urlModalInput.blur();
                $(this).text('{{__('Copied!')}}');
            });

            $createFolderModalButton.on('click', function (e) {
                const folderName = $createFolderModalInput.val();
                if(folderName.length > 0) {
                    confirmAction(function () {
                        $.ajax({
                            url: '{{ route('admin.media.folder') }}',
                            type: 'POST',
                            dataType: 'json',
                            data: {
                                folder_id: currentFolder,
                                name: folderName
                            }
                        }).done(function(response) {
                            folders[response.data.id] = response.data;

                            folderCount ++;
                            $(selectorNames.mediaSectionTitle).first().html(`${folderCount} Folders`);
                            $(mediaItemTemplate(response.data)).appendTo($viewContainer.first());
                            $createFolderModal.hide();
                        });
                    });
                }
            });

            $renameModalButton.on('click', function (e) {
                const name = $renameModalInput.val();
                if(
                    name.length > 0
                    && !(files[currentFile] && files[currentFile].name === name)
                    && !(folders[currentFile] && folders[currentFile].name === name)
                ) {
                    confirmAction(function () {
                        $.ajax({
                            url: '{{ route('admin.media.rename', '') }}/' + currentFile,
                            type: 'PUT',
                            dataType: 'json',
                            data: {
                                name: name
                            }
                        }).done(function(response) {
                            if(files[currentFile]) {
                                files[currentFile].name = name;
                            } else {
                                folders[currentFile].name = name;
                            }
                            $(`.media-item[data-id=${currentFile}] .file-name`).text(name);
                            $renameModal.hide();
                        });
                    });
                }
            });

            $btnYes.on('click', function (e) {
                let medias = [];
                $.each(selectedMedias, function (index, id) {
                    if(files[id]) {
                        medias.push({
                            id: id,
                            name: files[id].name,
                            url: files[id].url
                        });
                    }
                });
                window.dispatchEvent(new CustomEvent('mediaSelected', {
                    detail: medias
                }));
                window.close();
            });

            $btnClose.on('click', function (e) {
                window.close();
            });

            $('#myDropzone').dropzone({
                url: '{{ route('admin.media.upload') }}',
                maxFilesize: 100,
                paramName: 'file',
                parallelUploads: 1,
                autoProcessQueue: true,
                //acceptedFiles: '.jpeg,.jpg,.png,.gif',
                init: function () {
                    this.on('sending', function (file, xhr, data) {
                        data.append('folder_id', currentFolder);
                        // data.append('callback', options.callback);
                    });
                    this.on('success', function (file, response) {
                        files[response.data.id] = response.data;

                        fileCount ++;
                        $(selectorNames.mediaSectionTitle).last().html(`${fileCount} Files`);
                        $(mediaItemTemplate(response.data)).appendTo($viewContainer.last());

                    });
                }
            });

            initBreadcrumb();
            loadMedias();
        });
    </script>
@endpush
<div class="card media-manager">
    <div class="card-header border-bottom">
        <div>
            <button class="btn btn-outline-secondary btn-upload" data-bs-toggle="tooltip" title="{{ __('Upload') }}" disabled>
                <i class="fa fa-upload"></i>
            </button>
            <button class="btn btn-outline-secondary btn-create-folder" data-bs-toggle="tooltip" title="{{ __('Create Folder') }}" disabled>
                <i class="fa fa-folder-open"></i>
            </button>
            <button class="btn btn-primary btn-select-all" data-bs-toggle="tooltip" title="{{ __('Select All') }}" disabled>
                <i class="far fa-check-square"></i>
            </button>
            <button class="btn btn-warning btn-unselect-all" data-bs-toggle="tooltip" title="{{ __('Unselect All') }}" disabled>
                <i class="far fa-square"></i>
            </button>
            <button class="btn btn-danger btn-delete" data-bs-toggle="tooltip" title="{{ __('Delete') }}" disabled>
                <i class="fa fa-trash-alt"></i>
            </button>
            <button class="btn btn-success btn-reload" data-bs-toggle="tooltip" title="{{ __('Reload') }}" disabled>
                <i class="fa fa-sync"></i>
            </button>
        </div>
    </div>
    <div class="card-body bg-light pt-1">
        <nav aria-label="breadcrumb" class="d-flex justify-content-between align-items-center">
            <ol class="breadcrumb"></ol>
            <div class="btn-group view-toggle ms-50" role="group">
                <input type="radio" class="btn-check" name="view-btn-radio" value="grid" id="gridView" checked autocomplete="off" />
                <label class="btn btn-outline-primary p-50 btn-sm" for="gridView">
                    <i class="fa fa-th-large"></i>
                </label>
                <input type="radio" class="btn-check" name="view-btn-radio" value="list" id="listView" autocomplete="off" />
                <label class="btn btn-outline-primary p-50 btn-sm" for="listView">
                    <i class="fa fa-list"></i>
                </label>
            </div>
        </nav>
        <div class="media-content-body">
            <div class="view-container" style="display: none;">
                <h6 class="media-section-title mt-25 mb-75">{{ __('Folders') }}</h6>
                <div class="media-header">
                    <h6 class="fw-bold mb-0">{{ __('Filename') }}</h6>
                    <div>
                        <h6 class="fw-bold media-item-size d-inline-block mb-0">{{ __('Size') }}</h6>
                        <h6 class="fw-bold media-last-modified d-inline-block mb-0">{{ __('Last modified') }}</h6>
                        <h6 class="fw-bold d-inline-block me-1 mb-0">{{ __('Actions') }}</h6>
                    </div>
                </div>
            </div>
            <div class="view-loading">
                <div class="spinner-border" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
            <div class="view-container" style="display: none;">
                <h6 class="media-section-title mt-25 mb-75">{{ __('Files') }}</h6>
            </div>
        </div>
    </div>
    <div class="card-footer">
        <div>{{ __('Selected') }}: <span class="media-selected-count">0</span></div>
        <div>
            <button class="btn btn-primary me-1" disabled>{{__('Yes')}}</button>
            <button class="btn btn-outline-secondary">{{__('Close')}}</button>
        </div>
    </div>
</div>
<div class="modal modal-primary fade" id="uploadModal">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-upload"></i> {{ __('Upload') }}</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <form action="/" class="dropzone dropzone-area" id="myDropzone">
                    <div class="dz-message">{{ __('Drop files here or click to upload.') }}</div>
                    @csrf
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal modal-primary fade" id="createFolderModal">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-folder-open"></i> {{ __('Create Folder') }}</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <div class="mb-1">
                    <label class="form-label" for="inputFolderName">{{ __('Folder Name') }}</label>
                    <input type="text" class="form-control" id="inputFolderName" value="{{ __('New Folder') }}">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Close') }}</button>
                <button type="button" class="btn btn-primary">{{ __('Create') }}</button>
            </div>
        </div>
    </div>
</div>
<div class="modal modal-primary fade" id="renameModal">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-edit"></i> {{ __('Rename') }}: <span class="media-name"></span></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <div class="mb-1">
                    <label class="form-label" for="inputFolderName">{{ __('New Name') }}</label>
                    <input type="text" class="form-control" id="inputFolderName" value="{{ __('New Name') }}">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Close') }}</button>
                <button type="button" class="btn btn-primary">{{ __('Rename') }}</button>
            </div>
        </div>
    </div>
</div>
<div class="modal modal-primary fade" id="urlModal">
    <div class="modal-dialog modal-sm modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-link"></i> {{ __('Show Url') }}</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <div class="input-group">
                    <input type="text" class="form-control" aria-describedby="btnCopy" readonly />
                    <button class="btn btn-outline-primary waves-effect" id="btnCopy" type="button">{{ __('Copy') }}</button>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Close') }}</button>
            </div>
        </div>
    </div>
</div>
<div class="modal modal-slide-in fade show" id="infoModal">
    <div class="modal-dialog sidebar-lg">
        <div class="modal-content p-0">
            <div class="modal-header d-flex align-items-center justify-content-between mb-1 p-2">
                <h5 class="modal-title"></h5>
                <div>
                    <i data-feather="x" class="cursor-pointer" data-bs-dismiss="modal"></i>
                </div>
            </div>
            <div class="modal-body flex-grow-1 pb-sm-0 pb-1">
                <ul class="nav nav-tabs tabs-line" role="tablist">
                    <li class="nav-item">
                        <a
                            class="nav-link active"
                            data-bs-toggle="tab"
                            href="#details-tab"
                            role="tab"
                            aria-controls="details-tab"
                            aria-selected="true"
                        >
                            <i data-feather="file"></i>
                            <span class="align-middle ms-25">{{ __('Details') }}</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a
                            class="nav-link"
                            data-bs-toggle="tab"
                            href="#activity-tab"
                            role="tab"
                            aria-controls="activity-tab"
                            aria-selected="true"
                        >
                            <i data-feather="activity"></i>
                            <span class="align-middle ms-25">{{ __('Activity') }}</span>
                        </a>
                    </li>
                </ul>
                <div class="tab-content" id="infoTabContent">
                    <div class="tab-pane fade show active" id="details-tab" role="tabpanel" aria-labelledby="details-tab">
                        <div class="d-flex flex-column justify-content-center align-items-center py-5">
                            <img src="{{asset('images/icons/js.png')}}" alt="file-icon" height="64" />
                            <p class="mb-0 mt-1 media-size"></p>
                        </div>
{{--                        <h6 class="file-manager-title my-2">Settings</h6>--}}
{{--                        <ul class="list-unstyled">--}}
{{--                            <li class="d-flex justify-content-between align-items-center mb-1">--}}
{{--                                <span>File Sharing</span>--}}
{{--                                <div class="form-check form-switch">--}}
{{--                                    <input type="checkbox" class="form-check-input" id="sharing" />--}}
{{--                                    <label class="form-check-label" for="sharing"></label>--}}
{{--                                </div>--}}
{{--                            </li>--}}
{{--                            <li class="d-flex justify-content-between align-items-center mb-1">--}}
{{--                                <span>Synchronization</span>--}}
{{--                                <div class="form-check form-switch">--}}
{{--                                    <input type="checkbox" class="form-check-input" checked id="sync" />--}}
{{--                                    <label class="form-check-label" for="sync"></label>--}}
{{--                                </div>--}}
{{--                            </li>--}}
{{--                            <li class="d-flex justify-content-between align-items-center mb-1">--}}
{{--                                <span>Backup</span>--}}
{{--                                <div class="form-check form-switch">--}}
{{--                                    <input type="checkbox" class="form-check-input" id="backup" />--}}
{{--                                    <label class="form-check-label" for="backup"></label>--}}
{{--                                </div>--}}
{{--                            </li>--}}
{{--                        </ul>--}}
{{--                        <hr class="my-2"/>--}}
                        <h6 class="file-manager-title my-2">{{ __('Info') }}</h6>
                        <ul class="list-unstyled">
                            <li class="d-flex justify-content-between align-items-center">
                                <p>{{ __('Type') }}</p>
                                <p class="fw-bold media-type"></p>
                            </li>
                            <li class="d-flex justify-content-between align-items-center">
                                <p>{{ __('Size') }}</p>
                                <p class="fw-bold media-size"></p>
                            </li>
                            <li class="d-flex justify-content-between align-items-center">
                                <p>{{ __('Location') }}</p>
                                <p class="fw-bold media-location"></p>
                            </li>
                            <li class="d-flex justify-content-between align-items-center">
                                <p>{{ __('Owner') }}</p>
                                <p class="fw-bold media-owner"></p>
                            </li>
                            <li class="d-flex justify-content-between align-items-center">
                                <p>{{ __('Modified') }}</p>
                                <p class="fw-bold media-modified"></p>
                            </li>

                            <li class="d-flex justify-content-between align-items-center">
                                <p>{{ __('Created') }}</p>
                                <p class="fw-bold media-created"></p>
                            </li>
                        </ul>
                    </div>
{{--                    <div class="tab-pane fade" id="activity-tab" role="tabpanel" aria-labelledby="activity-tab">--}}
{{--                        <h6 class="file-manager-title my-2">Today</h6>--}}
{{--                        <div class="d-flex align-items-center mb-2">--}}
{{--                            <div class="avatar avatar-sm me-50">--}}
{{--                                <img src="{{asset('images/avatars/5-small.png')}}" alt="avatar" width="28" />--}}
{{--                            </div>--}}
{{--                            <div class="more-info">--}}
{{--                                <p class="mb-0">--}}
{{--                                    <span class="fw-bold">Mae</span>--}}
{{--                                    shared the file with--}}
{{--                                    <span class="fw-bold">Howard</span>--}}
{{--                                </p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="d-flex align-items-center">--}}
{{--                            <div class="avatar avatar-sm bg-light-primary me-50">--}}
{{--                                <span class="avatar-content">SC</span>--}}
{{--                            </div>--}}
{{--                            <div class="more-info">--}}
{{--                                <p class="mb-0">--}}
{{--                                    <span class="fw-bold">Sheldon</span>--}}
{{--                                    updated the file--}}
{{--                                </p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <h6 class="file-manager-title mt-3 mb-2">Yesterday</h6>--}}
{{--                        <div class="d-flex align-items-center mb-2">--}}
{{--                            <div class="avatar avatar-sm bg-light-success me-50">--}}
{{--                                <span class="avatar-content">LH</span>--}}
{{--                            </div>--}}
{{--                            <div class="more-info">--}}
{{--                                <p class="mb-0">--}}
{{--                                    <span class="fw-bold">Leonard</span>--}}
{{--                                    renamed this file to--}}
{{--                                    <span class="fw-bold">menu.js</span>--}}
{{--                                </p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="d-flex align-items-center">--}}
{{--                            <div class="avatar avatar-sm me-50">--}}
{{--                                <img src="{{asset('images/portrait/small/avatar-s-1.jpg')}}" alt="Avatar" width="28" />--}}
{{--                            </div>--}}
{{--                            <div class="more-info">--}}
{{--                                <p class="mb-0">--}}
{{--                                    <span class="fw-bold">You</span>--}}
{{--                                    shared this file with Leonard--}}
{{--                                </p>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <h6 class="file-manager-title mt-3 mb-2">3 days ago</h6>--}}
{{--                        <div class="d-flex align-items-start">--}}
{{--                            <div class="avatar avatar-sm me-50">--}}
{{--                                <img src="{{asset('images/portrait/small/avatar-s-1.jpg')}}" alt="Avatar" width="28" />--}}
{{--                            </div>--}}
{{--                            <div class="more-info">--}}
{{--                                <p class="mb-50">--}}
{{--                                    <span class="fw-bold">You</span>--}}
{{--                                    uploaded this file--}}
{{--                                </p>--}}
{{--                                <img src="{{asset('images/icons/js.png')}}" alt="Avatar" class="me-50" height="24" />--}}
{{--                                <span class="fw-bold">app.js</span>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                </div>
            </div>
        </div>
    </div>
</div>

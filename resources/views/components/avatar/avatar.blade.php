<div>
    <div class="col-xl-12 col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Status</h4>
            </div>
            <div class="card-body">
                <p class="card-text mb-0">
                    Use class <code>.avatar-status-{online | offline | away | busy}</code> after <code>.avatar-content</code>.
                </p>
                <div class="demo-inline-spacing">
                    <div class="avatar">
                        <img src="{{asset('images/portrait/small/avatar-s-20.jpg')}}" alt="avatar" width="32" height="32" />
                        <span class="avatar-status-offline"></span>
                    </div>
                    <div class="avatar bg-info">
                        <span class="avatar-content">BV</span>
                        <span class="avatar-status-busy"></span>
                    </div>
                    <div class="avatar bg-light-primary">
                        <span class="avatar-content"><i data-feather="github" class="avatar-icon"></i></span>
                        <span class="avatar-status-away"></span>
                    </div>
                    <div class="avatar bg-light-success">
                        <span class="avatar-content">AB</span>
                        <span class="avatar-status-online"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
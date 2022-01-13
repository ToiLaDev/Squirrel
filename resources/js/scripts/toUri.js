const toUri = function (str, replacement) {
    if (str === undefined) {
        return '';
    }
    if (replacement === undefined) {
        replacement = '-';
    }
    var unicode = {
        'a': 'áàảãạăắặằẳẵâấầẩẫậ',
        "c": "ç",
        'd': 'đ',
        'e': 'éèẻẽẹêếềểễệ',
        'i': 'íìỉĩị',
        'o': 'óòỏõọôốồổỗộơớờởỡợ',
        'u': 'úùủũụưứừửữự',
        'y': 'ýỳỷỹỵ',
    };
    str = str.replace(/^\s+|\s+$/g, '')
        .toLowerCase()
    ;

    for (let nonUnicode in unicode) {
        let i = 0, l = unicode[nonUnicode].length;
        for (; i < l; i++) {
            str = str.replace(new RegExp(unicode[nonUnicode].charAt(i), 'g'), nonUnicode);
        }
    }
    str = str.replace(/[^0-9a-zA-Z]/g, replacement)
        .replace(new RegExp(replacement + '{2,}', 'g'), replacement)
        .replace(new RegExp('(^' + replacement + ')|(' + replacement + '$)', 'g'), '')
    ;
    return str;
};
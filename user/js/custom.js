function check_words(e) {
    var MAX_WORDS = 251;
    var valid_keys = [8, 46];
    var words = this.value.split(' ');

    if (words.length >= MAX_WORDS && valid_keys.indexOf(e.keyCode) == -1) {
        e.preventDefault();
        words.length = MAX_WORDS;
        this.value = words.join(' ');
    }
}

var textarea = document.getElementById('description');
textarea.addEventListener('keydown', check_words);
textarea.addEventListener('keyup', check_words);


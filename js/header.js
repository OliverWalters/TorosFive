window.addEventListener('scroll', function () {
    var header = document.getElementById('header');
    var logo = document.getElementById('logo');
    if (window.scrollY > 70) {
        header.classList.add('header1');
        header.classList.remove('header2');
        logo.classList.remove('header__logo__img2');
        logo.classList.add('header__logo__img1');
    } else {
        header.classList.add('header2');
        header.classList.remove('header1');
        logo.classList.add('header__logo__img2');
        logo.classList.remove('header__logo__img1');
    }
});
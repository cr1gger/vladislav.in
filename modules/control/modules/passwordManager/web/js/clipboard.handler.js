document.addEventListener('click', function (e) {
    const target = e.target
    if (target.hasAttribute('data-copy')) {
        ClipboardJS.copy(target.getAttribute('data-copy'))
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });

        Toast.fire({
            icon: 'success',
            title: 'Скопировано!'
        })
    }
})

document.addEventListener('DOMContentLoaded', e => {

        document.querySelectorAll('.vin-modal-close').forEach(button => {

                button.addEventListener('click', e => {

                        e.currentTarget.parentNode.parentNode.parentNode.classList.toggle('d-flex');
                    }
                )
            }
        )
        document.querySelectorAll('[data-vin-modal]').forEach(item => {

                item.addEventListener('click', e => {

                        e.preventDefault();
                        const selector = e.currentTarget.getAttribute('data-vin-modal')
                        const container = document.querySelector('#' + selector)
                        const modal = container.querySelector('.vin-modal')
                        container.classList.toggle('d-flex');
                        modal.classList.add('animate__animated', 'animate__zoomInDown')
                    }
                )
            }
        )
    }
)

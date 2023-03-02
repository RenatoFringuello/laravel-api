import Swal from 'sweetalert2';

const forms = document.querySelectorAll('form');
forms.forEach((form, i) => {
    form.addEventListener('click', (event)=>{
        event.preventDefault();
        Swal.fire({
            title: 'Sei sicuro di volerlo cancellare?',
            text: "Questa azione non sarà reversibile",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, cancella'
          }).then((result) => {
            if (result.isConfirmed) {
              Swal.fire(
                'Cancellato!',
                'Il progetto è stato cancellato con successo.',
                'success'
                ).then(()=>{
                    form.submit();
                })
            }
          });
    })
});
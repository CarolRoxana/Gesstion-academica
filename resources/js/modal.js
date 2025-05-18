import swal from 'sweetalert2';

window.addEventListener('success', e => {
    const detail = e.detail[0];
    swal.fire({
        icon: 'success',
        title: detail.title,
        html: detail.message,
        imageWidth: 48,
        imageHeight: 48,
        width: 300,
        background: '#fff', 
        color: '#000',     
      
        confirmButtonColor: '#1269db',
    });
});
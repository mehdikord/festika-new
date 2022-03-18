import Swal from "sweetalert2";

class SweetAlert {

    SweetToastMessage(message,icon = 'success'){
        let background = '#00c853';
        if (icon === 'error'){
            background = '#ff1744';
        }
        if (icon === 'warning'){
            background = '#ffa000';
        }
        if (icon === 'info'){
            background = '#2979ff';
        }
        const Toast = Swal.mixin({
            toast: true,
            position: 'bottom',
            background:background,
            color:'#ffffff',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        Toast.fire({
            icon: icon,
            title: message
        })
    }

    SweetServerErrorMessage(){
        this.SweetToastMessage('مشکلی در ارتباط با سرور وجود دارد !','error')
    }
    SweetAlertMessage(message,title='پیام سیستم' ,icon='info'){
        Swal.fire({
            icon: icon,
            title: title,
            text: message,
            confirmButtonText:'باشه',
        })
    }

}
export default SweetAlert = new SweetAlert();

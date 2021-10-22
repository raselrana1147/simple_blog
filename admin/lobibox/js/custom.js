function error_meesage(message){
     Lobibox.notify('error',{
         size: 'normal',
         showClass: 'zoomIn', 
         hideClass: 'zoomOut',
         icon: true,
         rounded: true,
         delayIndicator: true,
         position: 'right bottom', //or 'center bottom'
         msg: message
     });
 }


 function success_meesage(message){
     Lobibox.notify('success',{
         size: 'normal',
         showClass: 'zoomIn', 
         hideClass: 'zoomOut',
         icon: true,
         rounded: true,
         delayIndicator: true,
         position: 'right bottom', //or 'center bottom'
         msg: message
     });
 }
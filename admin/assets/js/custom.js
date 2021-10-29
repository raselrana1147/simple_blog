(function(){
	//=====call databale======
	 $('#data_table').DataTable();

	 // delete confirm

	 $('body').on('click','.delete_item',function(e){
	    e.preventDefault();
	        var href=$(this).attr('href');
	         Swal.fire({
	           title: 'Are you sure?',
	           text: "Once delete you cannot retrieve!",
	           icon: 'warning',
	           showCancelButton: true,
	           confirmButtonColor: '#3085d6',
	           cancelButtonColor: '#d33',
	           confirmButtonText: 'Yes'
	         }).then((result) => {
	           if (result.isConfirmed) {
	                window.location=href;
	           }
	         })
      })


})();
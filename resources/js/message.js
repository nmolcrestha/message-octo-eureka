function imagePreview(input,selector) {
   if(input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function(e) {
         $(selector).attr('src', e.target.result);
      }
      reader.readAsDataURL(input.files[0]);
   }
 }

 function searchUsers(query) {
   $.ajax({
      method: 'GET',
      url: '/messenger/search',
      data: {query: query},
      success: function(data){
         $('.user_search_list_result').html(data.records);
      },
      error: function(xhr, status, error){

      }
   })
 }

 function debounce(callback, delay){
   let timerId;
   return function(...args){
      clearTimeout(timerId);
      timerId = setTimeout(() => {
         callback.apply(this, args);
      }, delay)
   }

 }

//  ON DOM LOAD
$(document).ready(function() {
    $('#select_file').change(function() {
        imagePreview(this, '.profile-image-preview');
    });

    const debounceSearch = debounce(function() {
      const value = $('.user_search').val();
      searchUsers(value);
    }, 500)

    $('.user_search').on('keyup', function (){
      let query = $(this).val();
      if(query.length>0) debounceSearch(); 
    })
});

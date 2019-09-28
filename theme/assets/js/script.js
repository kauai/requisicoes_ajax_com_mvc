$(() => {
   
    function load(action) {
       const load_div = $('.ajax_load') 
       if(action === 'open') {
           load_div.fadeIn().css("display","flex")
       } else {
           load_div.fadeOut()
       }
   }

   $('form').submit(function(e) {
       e.preventDefault()
       const form = $(this)
       const form_ajax = $('.form_ajax')
       const user = $('.users')

       $.ajax({
           url:form.attr('action'),
           data:form.serialize(),
           type:'POST',
           dataType:'json',
           beforeSend:() => {
              load("open")
           },
           success:(response) => {

              if(response.message) {
                  form_ajax.html(response.message).fadeIn()
              } else {
                  form_ajax.fadeOut(function(){
                      $(this).html('')
                  })
              }

              if(response.user) {
                  user.prepend(response.user)
              }
              
              document.querySelector('form').reset()
           },
           complete:() => {
              load('close')
           }

       })
    
   })


   $('body').on('click',"[data-action]",function(e) {
      e.preventDefault()
      const data = $(this).data()
      const div = $(this).parent()

      console.log(data.action)
      $.post(data.action,data,function() {
          console.log('testes')
          div.fadeOut()
      },'json')
      .fail(function(e) {
          console.log(e)
      })
    })
})

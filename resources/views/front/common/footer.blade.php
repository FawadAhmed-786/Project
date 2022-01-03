 <div style="background-color: #212121; margin-top:100px;    border-top: 5px solid #ad2917;" class="footer-basic">
      <footer>
        <div class="social">
          <a href="#" style="background-color: white"
            ><i style="color: black" class="fab fa-instagram"></i
          ></a>
          <a href="#" style="background-color: white"
            ><i style="color: black" class="fab fa-snapchat"></i
          ></a>
          <a href="#" style="background-color: white"
            ><i style="color: black" class="fab fa-twitter"></i
          ></a>
          <a href="#" style="background-color: white"
            ><i style="color: black" class="fab fa-facebook-f"></i
          ></a>
        </div>
        <ul class="list-inline">
          <li style="color: white; font-weight: 500" class="list-inline-item">
            Home
          </li>
          <li style="color: white; font-weight: 500" class="list-inline-item">
            About
          </li>
          <li style="color: white; font-weight: 500" class="list-inline-item">
            Terms
          </li>
          <li style="color: white; font-weight: 500" class="list-inline-item">
            Contact
          </li>
        </ul>
        <p class="copyright">Copyright &copy; <script>document.write(new Date().getFullYear());</script> Goashtwala.pk <i class="icon-heart" aria-hidden="true"></i></p>
      </footer>
    </div>
    <script src="{{asset('assets/js/all.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/js/pace.min.js')}}" type="text/javascript"></script>

<script type="text/javascript">
   $(".icon-down").click(function(){$("body,html").animate({scrollTop:550},2e3)}),$(document).ready(function(){$(".filter-button").click(function(){var o=$(this).attr("data-filter");"all"==o?$(".filter").show("1000"):($(".filter").not("."+o).hide("3000"),$(".filter").filter("."+o).show("3000"))}),$(".filter-button").removeClass("active")&&$(this).removeClass("active"),$(this).addClass("active")}),$(window).scroll(function(){$(this).scrollTop()>=50?$("#return-to-top").fadeIn(200):$("#return-to-top").fadeOut(200)}),$("#return-to-top").click(function(){$("body,html").animate({scrollTop:0},1e3)});


    $(document).ready(function() {
  $('.inputfield').attr('readOnly');
  $('.num-in span').click(function () {
      var $input = $(this).parents('.num-block').find('input.in-num');
    if($(this).hasClass('minus')) {
      var count = parseFloat($input.val()) - 1;
      count = count < 1 ? 1 : count;
      if (count < 2) {

        $(this).addClass('dis');
      }
      else {
        $(this).removeClass('dis');
      }
      $input.val(count);
    }
    else {
      if($input.val() == 20){
        $input.val(20);
      }else{
        var count = parseFloat($input.val()) + 1
        $input.val(count);
      }
      
      if (count > 1) {
        $(this).parents('.num-block').find(('.minus')).removeClass('dis');
      }
    }
    
    $input.change();
    return false;
  });
  
});
// product +/-

     $(document).ready(function() {$('#sidebarCollapse').on('click', function () {$('#sidebar').addClass('active');$('.wrapper').addClass('sidewidth');$('#side-overlay').addClass('open'); $('#body').addClass('k'); }); });
      $(document).ready(function() {$('#side-overlay').on('click', function () {$('#sidebar').removeClass('active'); $('.wrapper').removeClass('sidewidth'); $('#side-overlay').removeClass('open'); $('#body').removeClass('k'); });});  


      $(document).ready(function() {
       $('.toggle-overlay').on('click', function () { 
          $('aside').toggleClass('open');
        }); 
      });
(function($) {

    $(".cata-sub-nav").on('scroll', function() {
        $val = $(this).scrollLeft();

        if($(this).scrollLeft() + $(this).innerWidth()>=$(this)[0].scrollWidth){
            $(".nav-next").hide();
          } else {
          $(".nav-next").show();
        }

        if($val == 0){
          $(".nav-prev").hide();
        } else {
          $(".nav-prev").show();
        }
      });
    //console.log( 'init-scroll: ' + $(".nav-next").scrollLeft() );
    $(".nav-next").on("click", function(){
      $(".cata-sub-nav").animate( { scrollLeft: '+=340' }, 200);
      
    });
    $(".nav-prev").on("click", function(){
      $(".cata-sub-nav").animate( { scrollLeft: '-=340' }, 200);
    });

  })(jQuery);        
$(document).ready(function() {
    $(".toggle-password").click(function() {
      $(this).toggleClass("fa-eye fa-eye-slash");
      var input = $($(this).attr("toggle"));
      if (input.attr("type") == "password") {
        input.attr("type", "text");
      } else {
        input.attr("type", "password");
      }
    });


    $(".toggle-userpassword").click(function() {
      $(this).toggleClass("fa-eye fa-eye-slash");
      var input = $($(this).attr("toggle"));
      if (input.attr("type") == "password") {
        input.attr("type", "text");
      } else {
        input.attr("type", "password"); 
      }
    });

    $(".toggle-confirmpassword").click(function() {
      $(this).toggleClass("fa-eye fa-eye-slash");
      var input = $($(this).attr("toggle"));
      if (input.attr("type") == "password") {
        input.attr("type", "text");
      } else {
        input.attr("type", "password");
     
      }
    });
    
});  
 function showprice(Id) {

                var x = document.getElementById(`pickunit-${Id}`);
                var loader = document.getElementById(`overlay-${Id}`);
                var price = document.getElementById(`price-${Id}`);
                var showprice = document.getElementById(`showprice-${Id}`);
                var size = $(x).val();
                var id = Id;
                $.ajax({
                  headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                  type : 'get',
                  url :'/get-price',
                  data : {size:size,id:id},
                  beforeSend: function(){
                    $(loader).show();
                    $(price).hide();
                  },
                  success:function(data){
                    if(data.price == null){
                      alert("Please Refresh Page");
                      var a = "Rs 0/<span style='font-size: 12px;'>kg</span>";
                      $(showprice).html(a);
                    }else{
                      var a = "Rs "+ data.price +"/<span style='font-size: 12px;'>kg</span>";
                      $(showprice).html(a);
                    }
                    
                      $(price).show();
                    },error:function(){
                      alert("some technical error please try again fresh the page");
                    },complete:function(data){
                      $(loader).hide();
                    }
                  });  
      } 

      $(document).ready(function(){
        countfetch();        
      });

      function addcart(Id) {
        var id = Id;
        var cart = document.getElementById(`menu-add-${Id}`);
        var unitdata = document.getElementById(`pickunit-${Id}`);
        var quantitydata = document.getElementById(`quantity-${Id}`);
       
            $('#form_error').html('');$('#form_errors').html('');$('#form_success').html('');
          
             var unit = $(unitdata).val();
             var quantity = $(quantitydata).val();
            $.ajax({

                url:"/cart",
                method:"POST",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: { unit:unit, quantity:quantity, id:id },
                //data :{id:id},
                dataType:"json",
                beforeSend: function(){
                // Show image container
                $("#overlay-cart").show();
               },
                success:function(data)
                {
                    var errormsg = '',errorcount = '';
                    var successmsg = '';                  
                    if(data.errors)
                    {
                   
                        errormsg = '<div class="alert alert-danger">';
                        for(var count = 0; count < data.errors.length; count++)
                        {
                            errormsg += '<p>' + data.errors[count] + '</p>';
                            window.setTimeout(function() {
                                $(".alert").fadeTo(500, 0).slideUp(500, function(){
                                $(this).remove(); 
                                });
                            }, 10000);
                        }
                        errormsg += '</div>';

                    }
                    if(data.errorcount)
                    {
                        errorcount = '<div class="alert alert-danger">'+ data.errorcount +  '</div>';
                           window.setTimeout(function() {
                                $(".alert").fadeTo(500, 0).slideUp(500, function(){
                                $(this).remove(); 
                                });
                            }, 10000);

                    }
                    $('#form_errors').html(errorcount);
                    $('#form_error').html(errormsg);
                    if(data.success)
                    {
                        successmsg = '<div class="alert alert-success">' + data.success + '</div>';
                        $('.addcartmodal').modal('hide');
                        countfetch();
                        window.setTimeout(function() {
                            $(".alert").fadeTo(500, 0).slideUp(500, function(){
                            $(this).remove(); 
                            });
                        }, 10000);
                    }
                    $('#form_success').html(successmsg);
                },complete:function(data){
              // Hide image container
              $("#overlay-cart").hide();
             }
            });
        
      }  
      function countfetch(){
        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
        $.ajax({
            url: "/cart/count/",
            type: "post",       
            dataType: 'json',
            success:function(count){
               var get = '', getmobile='' ;
                if(count >= 1){
                  get = count;
                  getmobile =  count ;         
                }else{
                   get =  0 ;
                   getmobile =  0 ;
                }
                $('#getmobile').attr('data-count',getmobile);
                $('#get').attr('data-count',get);
              
            }
        }); 
     }    
</script>

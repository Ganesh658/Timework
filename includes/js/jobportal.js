$('.deleteItem').click(function(){
    var cnfm = confirm("Are You Sure..! Do You Want To Delete This One");
    if(cnfm == true)
    {
      return true;
    }
    else
    {
      return false;
    }
})
 
 $('.faqcms').on('click', function () {
    var oVal = $(this).attr('id');
    $('.faqcms').removeClass('is_active');
    $('.card_'+oVal).addClass('is_active');
  }); 
  
$(function(){
    if ($(window).width() < 992) {
      $(".navbar-collapse>ul>li>a, .navbar-collapse ul.sub-menu>li>a").on("click", function() {
        var element = $(this).parent("li");
        if (element.hasClass("open")) {
          element.removeClass("open");
          element.find("li").removeClass("open");
          element.find("ul").slideUp(500,"linear");
        }
        else {
          element.addClass("open");
          element.children("ul").slideDown();
          element.siblings("li").children("ul").slideUp();
          element.siblings("li").removeClass("open");
          element.siblings("li").find("li").removeClass("open");
          element.siblings("li").find("ul").slideUp();
        }
      });
    }
});  


$("#contactForm").validate({
    rules:{
       user_name:{

          required:true,  
  
        },
      user_email:{

          required:true,  
          email:true,           

        },

        user_phone:{

          required:true,
          number:true,
          maxlength:10,
          minlength:10,

        },
        user_subject:{

          required:true,

        },
         user_msg:{

          required:true,

        },
    },

    messages:{
      user_name:{

        required:"Please Enter Your Name",

      },
      user_email:{

        required:"Please Enter Email Id",
        email:"Please Enter A Valid Email-Address."

      },

      user_phone:{

        required:"Please Enter Your Phone Number",

      },
       user_subject:{

        required:"Please Enter Subject",

      },
      user_msg:{

        required:"Please Enter Description",

      }, 
    },

    errorClass: "help-inline",

    errorElement: "span",

    highlight:function(element, errorClass, validClass) {

      $(element).parents('.control-group').addClass('error');
    },

    unhighlight: function(element, errorClass, validClass) {

      $(element).parents('.control-group').removeClass('error');
    }, 
});      

$("#jobseekarregister").validate({
    rules:{
       js_name:{

          required:true,  
  
        },
      js_email:{

          required:true,  
          email:true,           

        },

        js_mobile:{

          required:true,
          number:true,
          maxlength:10,
          minlength:10,

        },
        js_password:{

          required:true,

        },
         js_cnfrmpassword:{

          required:true,
          equalTo:'#js_password',
        },

    },

    messages:{
      js_name:{

        required:"Please Enter Your Name",

      },
      js_email:{

        required:"Please Enter Your Email",
        email:"Please Enter A Valid Email-Address."

      },

      js_mobile:{

        required:"Please Enter Your Phone Number",

      },
       js_password:{

        required:"Please Enter Password",

      },
      js_cnfrmpassword:{

        required:"Please Enter Re-Enter Password",
        equalTo:"Please Enter The Same Password Again.",
      }, 
     
    },

    errorClass: "help-inline",

    errorElement: "span",

    highlight:function(element, errorClass, validClass) {

      $(element).parents('.control-group').addClass('error');
    },

    unhighlight: function(element, errorClass, validClass) {

      $(element).parents('.control-group').removeClass('error');
    }, 
}); 
function checkEmail()
{
  var sign_email = $("#js_email").val();
  var urlpath = baseurl+"index.php/login/checkExistEmail";
    $.ajax({

      type: "POST",

      url: urlpath,

      data: '&sign_email='+sign_email,

      success:function(msg)
      {
      
        if(msg == 'success')
        {
          $('.emailMsg').html('');
        }
        else if(msg == 'exist')
        {
          $('.emailMsg').html('');
          $('.emailMsg').html('<span style="color:red;font-size:14px;">Email id already Exists, please use another Email id</span>');
          $('#js_email').val('');
        }
        else
        {
          $('.emailMsg').html('');
          $('#js_email').val('');
        }
      }

    });
}
function checkMobile()
{
  var sign_mobile = $("#js_mobile").val();
  var urlpath = baseurl+"index.php/login/checkExistMobile";
    $.ajax({

      type: "POST",

      url: urlpath,

      data: '&sign_mobile='+sign_mobile,

      success:function(msg)
      {
      
        if(msg == 'success')
        {
          $('.mobileMsg').html('');
        }
        else if(msg == 'exist')
        {
          $('.mobileMsg').html('');
          $('.mobileMsg').html('<span style="color:red;font-size:14px;">Mobile Number already Exist. Please use another Mobile Number</span>');
          $('#js_mobile').val('');
        }
        else
        {
          $('.mobileMsg').html('');
          $('#js_mobile').val('');
        }
      }

    });
} 
$(document).ready(function() {
   $.validator.addMethod('nofreeemail', function (value) { 
      return /^([\w-\.]+@(?!gmail.com)(?!yahoo.com)(?!hotmail.com)(?!yahoo.co.in)(?!aol.com)(?!abc.com)(?!xyz.com)(?!pqr.com)(?!rediffmail.com)(?!live.com)(?!outlook.com)(?!me.com)(?!msn.com)(?!ymail.com)([\w-]+\.)+[\w-]{2,4})?$/.test(value); 
  }, 'Company Email Ids Allowed.');
$("#vendorregister").validate({
    rules:{
       v_name:{

          required:true,  
        },
        v_mobile:{

          required:true,
          number:true,
          maxlength:10,
          minlength:10,

        },
        rec_type:{

          required:true,  
        },
        v_businessname:{

          required:true,  
        },
        v_address:{

          required:true,  
        },
        v_state:{

          required:true,  
        },
        v_city:{

          required:true,  
        },
        v_area:{

          required:true,  
        },
        v_zipcode:{

          required:true,  
          number:true,
        },
        v_email:{

          required:true,  
          email:true,           
         // nofreeemail:true,
        },

        
        v_password:{

          required:true,

        },
         v_cnfrmpassword:{

          required:true,
          equalTo:'#v_password',
        },
    },

    messages:{
      v_name:{

        required:"Please Enter Your Company Name",

      },
       v_mobile:{

        required:"Please Enter Your Phone Number",

      },
      rec_type:{

        required:"Please Select You Are",

      },
      v_businessname:{

        required:"Please Enter Your Business Name",

      },
      v_address:{

        required:"Please Enter Your Address",

      },
      v_state:{

        required:"Please Select State",

      },
      v_city:{

        required:"Please Select City",

      },
       v_area:{

        required:"Please Enter Area Details",

      },
      v_zipcode:{

        required:"Please Enter Your Zipcode",
      },
      v_email:{

        required:"Please Enter Your Email",
        email:"Please Enter A Valid Email-Address.",
        //nofreeemail: "Please use your Company Email Address.",
      },
      v_password:{

        required:"Please Enter Password",

      },
      v_cnfrmpassword:{

        required:"Please Enter Re-Enter Password",
        equalTo:"Please enter the same Password again.",
      }, 
    },

    errorClass: "help-inline",

    errorElement: "span",
    errorPlacement: function(error, element) 
    {
        if ( element.is(":radio") ) 
        {
            error.appendTo( element.parents('.container') );
        }
        else 
        { // This is the default behavior 
            error.insertAfter( element );
        }
     },

    highlight:function(element, errorClass, validClass) {

      $(element).parents('.control-group').addClass('error');
    },

    unhighlight: function(element, errorClass, validClass) {

      $(element).parents('.control-group').removeClass('error');
    }, 
}); 
}); 
function checkVendorEmail()
{
  var sign_email = $("#v_email").val();
    var urlpath = baseurl+"index.php/login/checkExistEmail";
    $.ajax({

      type: "POST",

      url: urlpath,

      data: '&sign_email='+sign_email,

      success:function(msg)
      {
      
        if(msg == 'success')
        {
          $('.vemailMsg').html('');
        }
        else if(msg == 'exist')
        {
          $('.vemailMsg').html('');
          $('.vemailMsg').html('<span style="color:red;font-size:14px;">Email id already Exists, please use another Email id</span>');
          $('#v_email').val('');
        }
        else
        {
          $('.vemailMsg').html('');
          $('#v_email').val('');
        }
      }

    });

}
function checkVendorMobile()
{
  var sign_mobile = $("#v_mobile").val();
  var urlpath = baseurl+"index.php/login/checkExistMobile";
    $.ajax({

      type: "POST",

      url: urlpath,

      data: '&sign_mobile='+sign_mobile,

      success:function(msg)
      {
      
        if(msg == 'success')
        {
          $('.vmobileMsg').html('');
        }
        else if(msg == 'exist')
        {
          $('.vmobileMsg').html('');
          $('.vmobileMsg').html('<span style="color:red;font-size:14px;">Mobile Number already Exist. Please use another Mobile Number</span>');
          $('#v_mobile').val('');
        }
        else
        {
          $('.vmobileMsg').html('');
          $('#v_mobile').val('');
        }
      }

    });
}

$("#j_login").validate({
    rules:{

        loginemail:{

          required:true,  

        },

        loginpassword:{

          required:true,

        },

    },

    messages:{
    loginemail:{

      required:"Please Enter Your Email",
    },
    loginpassword:{

      required:"Please Enter Password",

    },

    },

    errorClass: "help-inline",

    errorElement: "span",

    highlight:function(element, errorClass, validClass) {

      $(element).parents('.control-group').addClass('error');
    },

    unhighlight: function(element, errorClass, validClass) {

      $(element).parents('.control-group').removeClass('error');
    }, 
}); 

$("#forgotpwd").validate({
  rules:{
    forgotemail:{
      required:true,  
      email:true,           
    },
  },
  messages:{
    forgotemail:{
      required:"Please Enter Your Email",
      email:"Please Enter A Valid Email-Address."

    },

  },

    errorClass: "help-inline",

    errorElement: "span",

    highlight:function(element, errorClass, validClass) {

      $(element).parents('.control-group').addClass('error');
    },

    unhighlight: function(element, errorClass, validClass) {

      $(element).parents('.control-group').removeClass('error');
    }, 
}); 
$("#resetForm").validate({
    rules:{

      forgot_otp:{

          required:true,  

        },
        reset_pwd:{

          required:true,  

        },
        reset_cnpwd:{

          required:true, 
           equalTo:"#reset_pwd", 

        },
    },

    messages:{
     
      forgot_otp:{

        required:"Enter your Reference Code",

      },
      reset_pwd:{

        required:"Enter your New Password",

      },
      reset_cnpwd:{

        required:"Re-type your password",
        equalTo: "Please Re-confirm the password again",

      },
    },

    errorClass: "help-inline",

    errorElement: "span",

    highlight:function(element, errorClass, validClass) {

      $(element).parents('.control-group').addClass('error');

    },

    unhighlight: function(element, errorClass, validClass) {

      $(element).parents('.control-group').removeClass('error');

    }, 
});
$(".filter_products").on( "click", function(){
  document.getElementById("mySidenav").style.width = "0";
    var stateId = $(this).val();
    var dataId = $(this).attr('data-id');
    if(stateId != '')
    {
        var dataString = "&stateId="+stateId+"&dataId="+dataId;
        $.ajax({
          type: "POST",
          url: baseurl+'index.php/jobseeker/getCitiesbystate',
          data: dataString, 
          cache: false,
          
          success: function(msg){
            if(msg != 'fail')
            {
              $('#cityInfo').show();
              $('#city-info').html('');
              $('#city-info').html(msg);
              if(dataId == 1)
              {
                 showRecValues();
              }
              else
              {
                 showValues();
              }
             
            }
            else
            {
              $('#cityInfo').hide();
              $('#city-info').html('');
            }
          },
        });
    }
} );
/*$(".filterproducts").on( "click", showValues );*/
$(document).on('click', '.filterproducts', function(){ showValues() });
function showValues() 
{
  document.getElementById("mySidenav").style.width = "0";
  var statesarray = new Array();

  $('input[name="statesType"]:checked').each(function(){  

    statesarray.push($(this).val());   

  });
  if(statesarray !='')
  {
    var stateslist = statesarray;
  }
  else
  {
      var stateslist = 0;
  }

  var cityarray = new Array();

  $('input[name="cityType"]:checked').each(function(){  

    cityarray.push($(this).val());   

  });
  if(cityarray !='')
  {
    var citylist = cityarray;
  }
  else
  {
      var citylist = 0;
  }

  var employmentTypearray = new Array();

  $('input[name="employmentType"]:checked').each(function(){  

    employmentTypearray.push($(this).val());   

  });
  if(employmentTypearray !='')
  {
    var emptypelist = employmentTypearray;
  }
  else
  {
      var emptypelist = 0;
  }

  var experienceinfoarray = new Array();

  $('input[name="experienceinfo"]:checked').each(function(){  

    experienceinfoarray.push($(this).val());   

  });
  if(experienceinfoarray !='')
  {
    var experiencelist = experienceinfoarray;
  }
  else
  {
      var experiencelist = 0;
  }

  
  var salaryrangeInfo = $('#salaryrangeInfo').val();
  if(salaryrangeInfo !='')
  {
    var salarylist = salaryrangeInfo;
  }
  else
  {
      var salarylist = 0;
  }

  var salarytypearray = new Array();

  $('input[name="salarytype"]:checked').each(function(){  

    salarytypearray.push($(this).val());   

  });
  if(salarytypearray !='')
  {
    var salarytypelist = salarytypearray;
  }
  else
  {
      var salarytypelist = 0;
  }

  var joiningtypearray = new Array();

  $('input[name="joiningtype"]:checked').each(function(){  

    joiningtypearray.push($(this).val());   

  });
  if(joiningtypearray !='')
  {
    var joiningtypelist = joiningtypearray;
  }
  else
  {
      var joiningtypelist = 0;
  }

  var jobfressnessarray = new Array();

  $('input[name="jobfressness"]:checked').each(function(){  

    jobfressnessarray.push($(this).val());   

  });
  if(jobfressnessarray !='')
  {
    var jobfressnesslist = jobfressnessarray;
  }
  else
  {
      var jobfressnesslist = 0;
  }
  var pagetype = $('#pagetype').val();
  if(pagetype == '')
  {
    var pagetype = 0;
  }
  var dataString = "&stateslist="+stateslist+"&citylist="+citylist+"&emptypelist="+emptypelist+"&experiencelist="+experiencelist+"&salarylist="+salarylist+"&salarytypelist="+salarytypelist+"&jobfressnesslist="+jobfressnesslist+"&joiningtypelist="+joiningtypelist+"&pagetype="+pagetype;
  $.ajax({
    type: "POST",
    url: baseurl+'index.php/jobseeker/getProductsByAttributes',
    data: dataString, 
    cache: false,
    beforeSend: function(){
        $("#ajaxloader").show();
       $("#targetResults").css("opacity",0);
    },
    success: function(msg){
      $('html, body').animate({
        scrollTop: $("#targetResults").offset().top-250
      }, "slow");
      $('.load-more').html("");
      $("#targetResults").html('');    
      $("#targetResults").html(msg);
    },
    complete:function(data){
        $("#ajaxloader").hide();
       $("#targetResults").css("opacity",'');
    }
  });
}

$(document).on('click', '.recfilter', function(){ showRecValues() });
function showRecValues() 
{
  var statesarray = new Array();

  $('input[name="statesType"]:checked').each(function(){  

    statesarray.push($(this).val());   

  });
  if(statesarray !='')
  {
    var stateslist = statesarray;
  }
  else
  {
      var stateslist = 0;
  }

  var cityarray = new Array();

  $('input[name="cityType"]:checked').each(function(){  

    cityarray.push($(this).val());   

  });
  if(cityarray !='')
  {
    var citylist = cityarray;
  }
  else
  {
      var citylist = 0;
  }

  var employmentTypearray = new Array();

  $('input[name="employmentType"]:checked').each(function(){  

    employmentTypearray.push($(this).val());   

  });
  if(employmentTypearray !='')
  {
    var emptypelist = employmentTypearray;
  }
  else
  {
      var emptypelist = 0;
  }

  var experienceinfoarray = new Array();

  $('input[name="experienceinfo"]:checked').each(function(){  

    experienceinfoarray.push($(this).val());   

  });
  if(experienceinfoarray !='')
  {
    var experiencelist = experienceinfoarray;
  }
  else
  {
      var experiencelist = 0;
  }

  
  var joiningtypearray = new Array();

  $('input[name="joiningtype"]:checked').each(function(){  

    joiningtypearray.push($(this).val());   

  });
  if(joiningtypearray !='')
  {
    var joiningtypelist = joiningtypearray;
  }
  else
  {
      var joiningtypelist = 0;
  }

  var shiftarray = new Array();

  $('input[name="shifttype"]:checked').each(function(){  

    shiftarray.push($(this).val());   

  });
  if(shiftarray !='')
  {
    var shiftlist = shiftarray;
  }
  else
  {
      var shiftlist = 0;
  }

  var jobfressnessarray = new Array();

  $('input[name="jobfressness"]:checked').each(function(){  

    jobfressnessarray.push($(this).val());   

  });
  if(jobfressnessarray !='')
  {
    var jobfressnesslist = jobfressnessarray;
  }
  else
  {
      var jobfressnesslist = 0;
  }
  var pagetype = $('#pagetype').val();
  if(pagetype == '')
  {
    var pagetype = 0;
  }
  var dataString = "&stateslist="+stateslist+"&citylist="+citylist+"&emptypelist="+emptypelist+"&experiencelist="+experiencelist+"&joiningtypelist="+joiningtypelist+"&shiftlist="+shiftlist+"&jobfressnesslist="+jobfressnesslist+"&pagetype="+pagetype;
  $.ajax({
    type: "POST",
    url: baseurl+'index.php/recruiter/getProductsByAttributes',
    data: dataString, 
    cache: false,
    beforeSend: function(){
        $("#ajaxloader").show();
       $("#targetResults").css("opacity",0);
    },
    success: function(msg){
      $('html, body').animate({
        scrollTop: $("#targetResults").offset().top-250
      }, "slow");
      $('.load-more').html("");
      $("#targetResults").html('');    
      $("#targetResults").html(msg);
    },
    complete:function(data){
        $("#ajaxloader").hide();
       $("#targetResults").css("opacity",'');
    }
  });
}

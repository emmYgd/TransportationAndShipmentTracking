//use windows event to hide data before page load.... Later things...
$(document).ready(function(){

  //handle default clicks:
  /*$("a #dummyA").click(function(event){
      event.preventDefault();
    });*/

  //hide the admin dashboard skeleton:
  //for hide and show respective pages:
  $(".loginPage").show();

  $("#adminDashboardSkeleton").hide();

  $("#details_set").hide();

  $("#saveNewDetails").hide();

  //logs in and fetch data by default:
  GeneralFetch(); 

  //generate tracking and reference code..
  generateTrackandRefCode(); 

  pointToDetails();

  //confirmPayment button handle:
  saveNewDetails();

  //get all saved info:
  //getSavedInfo();

  //logout:
  logOut();
});


let parseJSONdata = function(param){
  var jsonObj = JSON.parse(param);
  return jsonObj;
}


let GeneralFetch = function(){

  //Now call the object literal method when button is clicked:
  $("#login").click(function(event){

    event.preventDefault();

    //get the values of the admin detail:
    var adminPass = $("#adminPass").val();

    if(adminPass == ""){

      $("#validatePass").html("Password cannot be empty!");

    }else{

      //send over to the server:
      var req = $.ajax({
        url:"localhost/v1/login",
        method:"POST",//type
        data:{
          suppliedAdmin : adminPass
        }
      });

      //recieve result:
      req.done(function(resp){
        console.log(resp);
        var resp = parseJSONdata(resp);

        var serverStatus = resp.serverStatus;
        var serverCode = resp.code;

        if( (serverStatus == "adminFound") && (serverCode == 200) ){

          //for hide and show respective pages:production
          $(".loginPage").hide();
          $("#adminDashboardSkeleton").show();

          //showLogoutOption:
          $("a#logout").html("Logout");

        }else if(serverStatus == "notFound"){
          $("#validatePass").html("Failed login attempt, you are not an admin!");
        } 
      });

      //handle failure now:
      req.fail(function(){
        $("#errormessage").html("Failed to Login. Please, check your internet connection!");
      });

    }
  });
}


let generateTrackandRefCode = function(){

  //send through ajax:
  $("#code_generate").click(function(event){

    //console.log("I've been clicked");
    $("#saveNewDetails").show();

    /*first get the save status of inputed details - 
    through the message set to be displayed upon successful save:*/

    var saveStatus = $("#saveDataConfirm").val();
    //console.log("I've been clicked");

    if(saveStatus === ""){
      console.log("I've been clicked");
      var req = $.ajax({
        url:"Backend/AdminGenerateCodes.php",
        method:"GET"//type
      });

      req.done( function(resp){
        console.log(resp);
        var resp = parseJSONdata(resp);
      
        var trackingCode = resp.trackingCode;
        var referenceCode = resp.referenceCode;

        //fix the tracking code in the UI..
        $("#tracking_code").html(trackingCode);
        $("#reference_ID").html(referenceCode);
        $("#tracking_code_to_save").html(trackingCode);
        $("#reference_code_to_save").html(referenceCode);

        //change the button content:
        $("#gen_code").hide();
        $("#details_set").show();
      });

      req.fail(function(){
        //set the error message on the admin dashboard:'
        $("#errorMessage").html("Cannot generate code. Please check your internet connection and try again");
      });
    }
  });
}


let pointToDetails = function(){

  $("#set_details").click(function(event){
    $("#genNew").hide();
  });
}
  

let saveNewDetails = function(){

  //send through ajax:
  $("#saveNewDetails").click(function(event){

    //collect the values from the filled data:
    var shipmentDay = $("#shipmentDay").val();
    var shipmentMonth = $("#shipmentMonth").val();
    var shipmentYear = $("#shipmentYear").val();

    var shipmentHour = $("#shipmentHour").val();
    var shipmentMinute = $("#shipmentMinute").val();
    var shipmentSecond = $("#shipmentSecond").val();

    var deliveryDay = $("#deliveryDay").val();
    var deliveryMonth = $("#deliveryMonth").val();
    var deliveryYear = $("#deliveryYear").val();

    var shiperFullName = $("#shiperFullName").val();
    var shiperAddress = $("#shiperAddress").val();

    var receiverFullName = $("#receiverFullName").val();
    var receiverAddress = $("#receiverAddress").val();
    
    var price = $("#price").val();
    var status = $("#status").val();

    var commodity = $("#commodity").val();
    var commodityTypes = $("#commodityTypes").val();
    var commodityQuantity = $("#commodityQuantity").val();
    var commodityContent = $("#commodityContent").val();

    var destination = $("#destination").val();
    var origin = $("#origin").val();
    var portOrigin = $("#portOrigin").val();

    var mode = $("#mode").val();
    var weight_kgs = $("#weight_kgs").val();
    var weight_cubic = $("#weight_cubic").val();
    var allocation = $("#allocation").val();

    var service_type = $("#service_type").val();
    var size_type = $("#size_type").val();
    var add_info = $("#add_info").val();
    var shipmentTravelHistory = $("#shipmentTravelHistory").val();

    var trackingCode = $("#tracking_code_to_save").val();
    var referenceCode = $("#reference_code_to_save").val();

    //this is for the required input:
    var inputVal = $("input.required").val();

    //validate here:
    if(inputVal == "") { 
      $(".validation").html("Field cannot be empty!");
      $("#saveErrorConfirm").html("Some fields cannot be empty. Please fill up the necessary fields");
    }else{
      
        var req = $.ajax({
          url:"Backend/AdminParamSave.php",
          method:"POST",//type
          data:{

            shipmentDay: shipmentDay,
            shipmentMonth: shipmentMonth,
            shipmentYear: shipmentYear,

            shipmentHour: shipmentHour,
            shipmentMinute: shipmentMinute,
            shipmentSecond: shipmentSecond,

            deliveryDay: deliveryDay,
            deliveryMonth: deliveryMonth,
            deliveryYear: deliveryYear,

            shiperFullName: shiperFullName,
            shiperAddress: shiperAddress,

            receiverFullName: receiverFullName,
            receiverAddress: receiverAddress,

            price: price,
            status: status,

            commodity: commodity,
            commodityTypes: commodityTypes,
            commodityQuantity: commodityQuantity,
            commodityContent: commodityContent,

            destination: destination,
            origin: origin,
            portOrigin: portOrigin,
            mode: mode,

            weight_kgs: weight_kgs,
            weight_cubic: weight_cubic,
            allocation: allocation,

            service_type: service_type,
            size_type: size_type,
            add_info: add_info,
            shipmentTravelHistory: shipmentTravelHistory,

            trackingCode: trackingCode,
            referenceCode: referenceCode
          }

        });

        //start fixing data:
        req.done(function(resp){
          console.log(resp);
          //parse JSON:
          var resp = parseJSONdata(resp);

          if( (resp.serverStatus == "SuccessfullySaved")
              && (resp.code == 200) ){

            $("#tracking_code_to_save").html("");
            $("#reference_code_to_save").html("");
            $("form").trigger("reset");
            $("#saveDataConfirm").html("Data Successfully Saved in database. Generate new pin codes before saving your next entry.");

            $("#genNew").show();
            $("#saveNewDetails").hide();

          }else if((resp.serverStatus == "NotSaved")){
            $("#saveErrorConfirm").html("Error in saving to database, please retry.");
          }
        });
        
        req.fail(function(){
          //$("form").trigger("reset");
          $("#saveDataError").html("Please check your internet connection and try again");
        });
    }
  });
}


let logOut = function(){

  $("#logOut").click(function(event){
    
    var req = $.ajax({
      url:"Backend/AdminLogout.php",
      method:"GET",//type or method...
    });

    var url = "index.html";
    $(location).attr("href", url);

    
    req.done(function(resp){

      var resp = parseJSONdata(resp);

      if(resp.status == "sessionDestroyed"){
        //can JQuery redirect?:
        //window.location.replace("index.html");
        //request from server:
        //or use:
        var url = "index.html";
        $(location).attr("href", url);

      }else if(resp.status == "sessionNotDestroyed"){
        //can JQuery redirect?:
        //window.location.replace("index.html");
        //request from server:
        //or use:
        var url = "index.html";
        $(location).attr("href", url);
      }
    });

    //always do this:
    req.always(function(resp){
      //can JQuery redirect?:
      //window.location.replace("index.html");
      //request from server:
      //or use:
      var url = "index.html";
      $(location).attr("href", url);
    });

    req.fail(function(){
      //attach an event to one of the id:
      //can JQuery redirect?:
      //window.location.replace("index.html");
      //request from server:
      //or use:
      var url = "index.html";
      $(location).attr("href", url);
    });
    
  });
} 


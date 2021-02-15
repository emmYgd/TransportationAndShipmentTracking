$(document).ready(function(){

  //hide by default:
  $("#track_ref").hide();
  $("#reference_code_search").hide();

  //get all saved info:
  getSavedInfo();

  //update all param details through your tracking or reference number..
  getSpecificInfo();

  //update the shipment price and status:
  updateShipmentPrice();
});


let getSavedInfo = function(){

  $("#viewTrackRefBtn").click(function(event){
    console.log("Clicked!");

    $("#track_ref").show();

    var req = $.ajax({
      url:"Backend/AdminGetAllTrackAndRef.php",
      method:"GET"//type
    });

    req.done(function(resp){
      console.log(resp);
      var resp = parseJSONdata(resp);

      var serverStatus = resp.serverStatus;
      var code = resp.code;
      var trackingCodes = $response['TrackingCode'];
      var referenceCodes = $response['ReferenceCodes'];

      if( (serverStatus == "FetchSuccess") && (code == 200)){
          
        //iterate through all the keys and values in the json:
        $.each(trackingCodes, function(key, value) {

          console.log(key, value);

          //display this to the client...
          //$("#viewAllDetailsBtn").hide();
          var keyUIrender  = "<span>" + key + ":" + "</span>";
          var valueUIrender = "<span>" + value + "</span>";

          $("p#tracking_codes").append("<p>" + keyUIrender + "" + valueUIrender + "</p>");
        });

        //iterate through all the keys and values in the json:
        $.each(referenceCodes, function(key, value) {

          console.log(key, value);

          //display this to the client...
          //$("#viewAllDetailsBtn").hide();
          var keyUIrender  = "<span>" + key + ":" + "</span>";
          var valueUIrender = "<span>" + value "</span>";

          $("p#reference_codes").append("<p>" + keyUIrender + "" + valueUIrender + "</p>");
        });
      }else{
        $("#errorTrackRef").html("Server Error in retrieving tracking and reference codes, Please try again later!");
      }
    });

    //handle failure now:
    req.fail(function(){
      $("#errorTrackRef").html("Failed to retrieve the tracking and reference codes generated so far. Please, check your internet connection and retry!");
    });

  });
}


let getSpecificInfo = function(){

  $("#search_update_btn").click(function(event){

    console.log("Search is here!");

    var trackCode = $("#track_code_search").val();
    var referenceCode = $("#reference_code_search").val();

    if( (trackingCode == "") || (referenceCode == "") ){
      event.preventDefault();
      $("#empty_error").html("Field cannot be empty");
    }else{

      var req = $.ajax({
        url:"Backend/AdminGetDetailsByTrack_Ref.php",
        method:"POST"//type
        data:{
          trackingCode: trackingCode,
          referenceCode: referenceCode
        }
      });

      req.done(function(resp){
        console.log(resp);
        var resp = parseJSONdata(resp);
        if( (resp.serverStatus == "FetchSuccess") && (resp.code == 200) ){

          $("#loadingShipmentIcon").hide();
          $("#search_success").html("Successfully fecthed Shipment details");

           //iterate through all the keys and values in the json:
          $.each(response.shipmentDetails, function(key, value) {

              console.log(key, value);

            //display this to the client...
            //$("#viewAllDetailsBtn").hide();
            var keyUIrender  = "<span>" + key + ":" + "</span>";
            var valueUIrender = "<span>" + value + "</span>";

            $("#shipmentContents").append("<p>" + keyUIrender + "" + valueUIrender + "</p>");
          });
        }else if( (resp.serverStatus == "FetchFailed") && (resp.code == 400) ){
          $("#search_error").html("Error! could not find the shipment details associated with this supplied code");
        }
      });

      req.fail(function(){
        $("#search_error").html("Please, check your internet services");
      });

    }
  });
}


let updateShipmentPrice = function(){

  $("#updateStatus_Price").click(function(event){

    console.log("Update is here!");

    var priceUpdate = $("#statusUpdate").val();
    var statusUpdate = $("#priceUpdate").val();

    if( (priceUpdate == "") || (statusUpdate == "") ){

      $("#updateError").html("At least one field should be filled");

    }else{

      var req = $.ajax({
        url:"Backend/AdminParamUpdate.php",
        method:"POST"//type
        data:{
          price: priceUpdate,
          status: statusUpdate
        }
      });

      req.done(function(resp){
        console.log(resp);
        var resp = parseJSONdata(resp);
        if( (resp.serverStatus == "UpdateSuccess") && (resp.code == 200) ){

          $("#updateSuccess").html("Successfully updated Shipment details");

        }else if( (resp.serverStatus == "UpdateFailed") && (resp.code == 400) ){
          $("#updateError").html("Error! could not update Shipment details");
        }
      });

      req.fail(function(){
        $("#updateError").html("Please, check your internet connection");
      });

    }
  });
} 
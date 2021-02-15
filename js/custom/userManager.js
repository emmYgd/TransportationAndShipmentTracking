$(document).ready(function(){

	handleQuote();

	reset();

	trackUserDetails();
});

let handleQuote = function(){

	$("details_submit").click(function(event){

		event.preventDefault();

	});

}


let reset = function(){
	
	$("#reset").click(function(event){

		event.preventDefault();

		//$("form").trigger("reset");
		var url = "index.html";
        $(location).attr("href", url);

	});
}


let trackUserDetails = function(){

	$("#track").click(function(event){

		//console.log("Hello Dear");
		var trackingVal = $("#track_code").val();
		//var refVal = $("#ref_code").val();
		console.log(trackingVal);

		if(trackingVal === ""){

			console.log("Empty!");
			$("#code_empty").html("Tracking or Reference code field cannot be empty!");
			$("#shipmentContents").hide();

		}else{

			console.log("Not Empty!");
			$("#code_empty").hide();
			$("#shipmentContents").show();

			var req = $.ajax({
        		url:"Backend/UserSearchShipmentDetails.php",
        		method:"POST",//types
        		data:{
          			trackingCode : trackingVal,
          			referenceCode : ""
        		}
      		});

			req.done(function(resp){
				
				console.log(resp);
				var resp = parseJSONdata(resp);

				if(resp.serverStatus == "FetchSuccess" && resp.code == 200){

					$("#search_success").html("Fetch Successful!");
					$("#loadingShipmentIcon").hide();

					//fix obtained data into the UI:
					$("#user_ship_day").html(resp.shipmentDetails.ShipmentDay);
					$("#user_ship_month").html(resp.shipmentDetails.ShipmentMonth);
					$("#user_ship_year").html(resp.shipmentDetails.ShipmentYear);

					$("#user_ship_hour").html(resp.shipmentDetails.ShipmentHour);
					$("#user_ship_minute").html(resp.shipmentDetails.ShipmentMinute);
					$("#user_ship_second").html(resp.shipmentDetails.ShipmentSecond);

					$("#delivery_day").html(resp.shipmentDetails.DeliveryDay);
					$("#delivery_month").html(resp.shipmentDetails.DeliveyMonth);
					$("#delivery_year").html(resp.shipmentDetails.DeliveryYear);

					$("#ship_full_name").html(resp.shipmentDetails.ShipperFullName);
					$("#ship_address").html(resp.shipmentDetails.ShipperAddress);

					$("#receive_full_name").html(resp.shipmentDetails.ReceiverFullName);
					$("#receive_address").html(resp.shipmentDetails.ReceiverAddress);

					$("#user_price").html(resp.shipmentDetails.Price);
					$("#user_status").html(resp.shipmentDetails.Status);

					$("#user_commodity").html(resp.shipmentDetails.Commodity);
					$("#user_commodity_types").html(resp.shipmentDetails.CommodityTypes);
					$("#user_commodity_quantity").html(resp.shipmentDetails.CommodityQuantity);
					$("#user_commodity_content").html(resp.shipmentDetails.CommodityContent);

					$("#user_destination").html(resp.shipmentDetails.Destination);
					$("#user_origin").html(resp.shipmentDetails.Origin);
					$("#user_port_origin").html(resp.shipmentDetails.PortOrigin);

					$("#user_mode").html(resp.shipmentDetails.Mode);
					$("#user_weight_kgs").html(resp.shipmentDetails.WeightKgs);
					$("#user_weight_cubic").html(resp.shipmentDetails.WeightCubicMeters);

					$("#user_allocation").html(resp.shipmentDetails.Allocation);
					$("#user_service_type").html(resp.shipmentDetails.ServiceType);
					$("#user_size_type").html(resp.shipmentDetails.SizeType);

					$("#user_travel_history").html(resp.shipmentDetails.ShipmentTravelHistory);
					$("#user_add_info").html(resp.shipmentDetails.AdditionalInformation);
					
				}else if(resp.serverStatus == "FetchFailed" && resp.code == 400){

					var track_link = "index.html#track";
					$("#search_error").append("<p>Fetch Error, Pls <a href=" + track_link + "><u>try again</u></p>");
					$("#loadingShipmentIcon").hide();

				}
			});

		}

	});
}

let parseJSONdata = function(param){
  var jsonObj = JSON.parse(param);
  return jsonObj;
}
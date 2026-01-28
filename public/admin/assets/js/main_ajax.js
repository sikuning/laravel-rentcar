$(function () {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });


    var base_url = $('#url').val();
    var current_url = $('#url').val();

    //show input error with ajax
    function show_formAjax_error(data){
        if (data.status == 422) {
            $('.error').remove();
            $('.loader').hide();
            $.each(data.responseJSON.errors, function (i, error) {
                var el = $(document).find('[name="' + i + '"]');
                el.after($('<span class="error">' + error[0] + '</span>'));
            });
        }
    }

    
    // delete post common function
    function destroy_post(name,url){
        if(confirm('Are you Sure Want to Delete This')){
            var el = name;
            var id= el.attr('data-id');
            var dltUrl = url+id;
            $.ajax({
                url: dltUrl,
                type: "DELETE",
                cache: false,
                success: function(dataResult){
                    if(dataResult == '1'){
                        el.parent().parent('tr').remove();
                    }else{
                        alert(dataResult);
                    }
                }
            });
        }
    }

    // load datatables common function
    function load_dataTable(element,url,columns){

        var table = $(element).DataTable({
            processing: true,
            serverSide: true,
            ajax: url,
            columns: cols,
        });
    }

// ========================================    
// script for car inventory module 
// ========================================

    // load table
    let cols = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'image'},
            {data: 'car_name'},
            {data: 'price'},
            {data: 'type_name'},
            {data: 'trans_name'},
            {
                data: 'action',
                orderable: true, 
                searchable: true
            },
        ];
    load_dataTable('#inventory-list','carInventory',cols)


    $("#add_car").validate({
        rules: {
            car_name: { required: true },
            car_type: { required: true },
            fuel_type: { required: true },
            mileage: { required: true,digits: true },
            model_year: { required: true, digits: true },
            transmission: { required: true },
            passengers: { required: true, digits: true },
            doors: { required: true, digits: true },
            bags: { required: true, digits: true },
            img: { required: true },
            descr: { required: true },
            price: { required: true, digits: true }
        },
        submitHandler: function(form) {
            $('.card .card-body').append('<div class="loader"></div>');
            var formdata = new FormData(form);
            var url = base_url+'/admin/carInventory'
            $.ajax({
                url: url,
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success:function(dataResult){
                    if(dataResult == '1'){
                        $('body').append('<div class="response-alert alert alert-success">Added Successfully.</div>');
                        setTimeout(function(){
                            $('.response-alert').remove();
                            window.location.href = url;
                        }, 1000);
                    }else{
                        $('body').append('<div class="response-alert alert alert-danger">'+dataResult+'</div>');
                        setTimeout(function(){
                            $('.response-alert').remove();
                            window.location.reload();
                        }, 1000);
                    }
                },
                error: function (data) {
                    show_formAjax_error(data);
                }
            });
        }
   });

   $("#update_car").validate({
        rules: {
            car_name: { required: true },
            car_type: { required: true },
            fuel_type: { required: true },
            mileage: { required: true,digits: true },
            model_year: { required: true, digits: true },
            transmission: { required: true },
            passengers: { required: true, digits: true },
            doors: { required: true, digits: true },
            bags: { required: true, digits: true },
            descr: { required: true },
            price: { required: true, digits: true }
        },
        
        submitHandler: function(form) {
            $('.card .card-body').append('<div class="loader"></div>');
            var url = base_url+'/admin/carInventory';
            var id = $('input[name=id]').val();
            var formdata = new FormData(form);
            $.ajax({
                url: url+'/'+id,
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success:function(dataResult){
                    console.log(dataResult);
                    if(dataResult == '1' || dataResult == '0'){
                        $('body').append('<div class="response-alert alert alert-success">Updated Successfully.</div>');
                        setTimeout(function(){
                            $('.response-alert').remove();
                            window.location.href = url;
                        }, 1000);
                    }
                },
                error: function (data) {
                    show_formAjax_error(data);
                }
            });
        }
   });

    $(document).on("click", ".delete-carInvtry", function() {
        destroy_post($(this),'carInventory/')
    });


// ========================================    
// script for car Types module 
// ========================================

    cols = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex',sWidth: '20px'},
            {data: 'name', name: 'name'},
            {
                data: 'action', 
                name: 'action', 
                orderable: true, 
                searchable: true,
                sWidth: '100px'
            },
        ];
    load_dataTable('#carTypes-list','carTypes',cols);

    

    $("#addCarTypes").validate({
        // rules
        rules: {
            name: "required",
            desc: "required",
        },
        // submit handler
        submitHandler: function(form) {
            $('.card .card-body').append('<div class="loader"></div>');
            var formdata = new FormData(form);
            var url = base_url+'/admin/carTypes';
            $.ajax({
                url : url,
                type : 'POST',
                data : formdata,
                cache: false,
                processData: false,
                contentType: false,
                success : function(dataResult){
                    console.log(dataResult)
                    if(dataResult == '1'){
                        $('body').append('<div class="response-alert alert alert-success">Added Successfully.</div>');
                        setTimeout(function(){
                            $('.response-alert').remove();
                            window.location.href = url;
                        }, 1000);
                    }
                },
                error: function (data) {
                    show_formAjax_error(data);
                }
            })
        }
    });


    $("#updateCarTypes").validate({
        // rules
        rules: {
            name: "required",
            desc: "required",
        },
        // submit handler
        submitHandler: function(form) {
            $('.card .card-body').append('<div class="loader"></div>');
            var formdata = new FormData(form);
            var url = base_url+'/admin/carTypes';
            var id = $('input[name=id]').val();
            $.ajax({
                url : url+'/'+id,
                type : 'POST',
                data : formdata,
                cache: false,
                processData: false,
                contentType: false,
                success : function(dataResult){
                    if(dataResult == '1'){
                        $('body').append('<div class="response-alert alert alert-success">Updated Successfully.</div>');
                        setTimeout(function(){
                            $('.response-alert').remove();
                            window.location.href = url;
                        }, 1000);
                    }
                },
                error: function (data) {
                    show_formAjax_error(data);
                }
            })
        }
    });
    

    $(document).on("click", ".delete-carType", function() { 
        destroy_post($(this),'carTypes/')
    });


// ========================================    
// script for Extras module 
// ========================================

    cols = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'name', name: 'name'},
            {
                data: 'action', 
                name: 'action', 
                orderable: true, 
                searchable: true
            }, 
        ];
    load_dataTable('#extras-list','extras',cols);

    $("#extraCreate_form").validate({
        // rules
        rules: {
            name: "required",
            price: {
                required: true,
                digits: true
            },
        },
        // error messages
        messages: {
            name: "Name is Required.",
            price: {
                required: 'Price is Required',
                digits: 'Enter Correct Price',
            },
        },
        // submit handler
        submitHandler: function(form) {
            $('.card .card-body').append('<div class="loader"></div>');
            var formdata = new FormData(form);
            var url = base_url+'/admin/extras';
            $.ajax({
                url : url,
                type : 'POST',
                data : formdata,
                cache: false,
                processData: false,
                contentType: false,
                success : function(dataResult){
                    console.log(dataResult);
                    if(dataResult == '1'){
                       $('body').append('<div class="response-alert alert alert-success">Added Successfully.</div>');
                        setTimeout(function(){
                            $('.response-alert').remove();
                            window.location.href = url;
                        }, 1000);
                    }
                },
                error: function (data) {
                    show_formAjax_error(data);
                }
            })
        }
    });

    $("#updateExtras").validate({
        // rules
        rules: {
            name: "required",
            price: {
                required: true,
                digits: true
            },
        },
        // error messages
        messages: {
            name: "Name is Required.",
            price: {
                required: 'Price is Required',
                digits: 'Enter Correct Price',
            },

        },
        // submit handler
        submitHandler: function(form) {
            $('.card .card-body').append('<div class="loader"></div>');
            var formdata = new FormData(form);
            var url = base_url+'/admin/extras';
            var id = $('input[name=id]').val();
            $.ajax({
                url : url+'/'+id,
                type : 'POST',
                data : formdata,
                cache: false,
                processData: false,
                contentType: false,
                success : function(dataResult){
                    if(dataResult == '1'){
                        $('body').append('<div class="response-alert alert alert-success">Updated Successfully.</div>');
                        setTimeout(function(){
                            $('.response-alert').remove();
                            window.location.href = url;
                        }, 1000);
                    }
                },
                error: function (data) {
                    show_formAjax_error(data);
                }
            })
        }
    });

    $(document).on("click", ".delete-extras", function() { 
        destroy_post($(this),'extras/')
    });


// ========================================    
// script for Locations module 
// ========================================

    cols = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'name', name: 'name'},
            {data: 'address', name: 'address'},
            {data: 'city', name: 'city'},
            {data: 'state', name: 'state'},
            {
                data: 'action', 
                name: 'action', 
                orderable: true, 
                searchable: true
            }, 
        ];
    load_dataTable('#locations-list','locations',cols);

    

    $("#addLocations").validate({
        // rules
        rules: {
            name: "required",
            email: {
                required: true,
                email: true
            },
            phone: {
                required: true,
                number: true
            },
            address: "required",
            zipcode: {
                required: true,
                number: true
            },
            country: "required",
            state: "required",
            city: "required",
            latitude: "required",
            longitude: "required",
        },
        // error messages
        messages: {
            name: "Name is Required",
            email: {
                required: "Email is Required",
                email: "Enter Valid Email"
            },
            phone: {
                required: "Phone Number is Required",
                email: "Enter Correct Phone Number"
            },
            address: "Address is Required",
            zipcode: {
                required: "Zipcode is Required",
                email: "Enter Correct Zipcode"
            },
            country: "Country Name is Required",
            state: "State Name is Required",
            city: "City Name is Required",
            latitude: "Latitude is Required",
            longitude: "Longitude is Required",

        },
        // submit handler
        submitHandler: function(form) {
            $('.card .card-body').append('<div class="loader"></div>');
            var formdata = new FormData(form);
            var url = base_url+'/admin/locations';
            $.ajax({
                url : url,
                type : 'POST',
                data : formdata,
                cache: false,
                processData: false,
                contentType: false,
                success : function(dataResult){
                    console.log(dataResult);
                    if(dataResult == '1'){
                        $('body').append('<div class="response-alert alert alert-success">Added Successfully.</div>');
                        setTimeout(function(){
                            $('.response-alert').remove();
                            window.location.href = url;
                        }, 1000);
                    }
                }
            })
        }
    });


    $("#updateLocations").validate({
        // rules
        rules: {
            name: "required",
            email: {
                required: true,
                email: true
            },
            phone: {
                required: true,
                number: true
            },
            address: "required",
            zipcode: {
                required: true,
                number: true
            },
            country: "required",
            state: "required",
            city: "required",
            latitude: "required",
            longitude: "required",
            // thumb: "required",
        },
        // error messages
        messages: {
            name: "Name is Required",
            email: {
                required: "Email is Required",
                email: "Enter Valid Email"
            },
            phone: {
                required: "Phone Number is Required",
                email: "Enter Correct Phone Number"
            },
            address: "Address is Required",
            zipcode: {
                required: "Zipcode is Required",
                email: "Enter Correct Zipcode"
            },
            country: "Country Name is Required",
            state: "State Name is Required",
            city: "City Name is Required",
            latitude: "Latitude is Required",
            longitude: "Longitude is Required",

        },
        // submit handler
        submitHandler: function(form) {
            $('.card .card-body').append('<div class="loader"></div>');
            var formdata = new FormData(form);
            var URL = $('.url').val();
            $.ajax({
                url : URL,
                type : 'POST',
                data : formdata,
                cache: false,
                processData: false,
                contentType: false,
                success : function(dataResult){
                    console.log(dataResult);
                    if(dataResult == '1'){
                        $('body').append('<div class="response-alert alert alert-success">Updated Successfully.</div>');
                        setTimeout(function(){
                            $('.response-alert').remove();
                            window.location.href = $('.rdt-url').val();
                        }, 1000);
                    }
                }
            })
        }
    });
    

    $(document).on("click", ".delete-locations", function() { 
        destroy_post($(this),'locations/')
    });

    // ========================================
    // script for Bookings module
    // ========================================

    cols = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'user_name', name: 'user_id'},
            {data: 'car_name', name: 'car_name'},
            {data: 'pick_date', name: 'pick_date'},
            {data: 'return_date', name: 'return_date'},
            {data: 'location_name', name: 'pic_loc'},
            {data: 'created_at', name: 'created_at'},
            
        ];
    load_dataTable('#bookings-list','bookings',cols);

    // ========================================
    // script for Payment Methods module
    // ========================================

    cols = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'name', name: 'name'},
            {
                data: 'action',
                name: 'action',
                orderable: true,
                searchable: true
            },
        ];
    load_dataTable('#payMethod-list','payMethod',cols);

    

    $("#add_payMethod").validate({
        // rules
        rules: {
            name: "required",
            key: "required",
            secret: "required",
            status: "required",
        },
        // submit handler
        submitHandler: function(form) {
          $('.card .card-body').append('<div class="loader"></div>');
            var formdata = new FormData(form);
            var toUrl = base_url+'/admin/payMethod';
            $.ajax({
                url : toUrl,
                type : 'POST',
                data : formdata,
                cache: false,
                processData: false,
                contentType: false,
                success : function(dataResult){
                   if(dataResult == '1'){
                        $('body').append('<div class="response-alert alert alert-success">Added Successfully.</div>');
                        setTimeout(function(){
                            $('.response-alert').remove();
                            window.location.href = toUrl;
                        }, 1000);
                   }
                },
                error: function (data) {
                    show_formAjax_error(data)
                }
            })
        }
    });


    $("#updatePayMethod").validate({
        // rules
        rules: {
            name: "required",
            key: "required",
            secret: "required",
            status: "required",
        },
        // submit handler
        submitHandler: function(form) {
            $('.card .card-body').append('<div class="loader"></div>');
            var formdata = new FormData(form);
            var id = $('input[name=id]').val();
            var toUrl = base_url+'/admin/payMethod/'+id;
            $.ajax({
                url : toUrl,
                type : 'POST',
                data : formdata,
                cache: false,
                processData: false,
                contentType: false,
                success : function(dataResult){
                    if(dataResult == '1'){
                        $('body').append('<div class="response-alert alert alert-success">Updated Successfully.</div>');
                        setTimeout(function(){
                            $('.response-alert').remove();
                            window.location.href = base_url+'/admin/payMethod';
                        }, 1000);
                    }
                },
                error: function (data) {
                    show_formAjax_error(data)
                }
            })
        }
    });

   $(document).on("click", ".delete-payMethod", function() {
        destroy_post($(this),'payMethod/')
   });

    // ========================================
    // script for FuelTypes module
    // ========================================

    cols = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex',sWidth:'20px'},
            {data: 'name', name: 'name'},
            {
                data: 'action',
                name: 'action',
                orderable: true,
                searchable: true,
                sWidth: '100px'
            },
        ];
    load_dataTable('#fuel_type-list','fuelTypes',cols);


    $("#add_fuelTypes").validate({
        // rules
        rules: {
            name: "required",
        },
        // submit handler
        submitHandler: function(form) {
         $('.card .card-body').append('<div class="loader"></div>');
            var formdata = new FormData(form);
            var url = base_url+'/admin/fuelTypes';
            $.ajax({
                url : url,
                type : 'POST',
                data : formdata,
                cache: false,
                processData: false,
                contentType: false,
                success : function(dataResult){
                //console.log(dataResult);
                if(dataResult == '1'){
                        $('body').append('<div class="response-alert alert alert-success">Added Successfully.</div>');
                        setTimeout(function(){
                            $('.response-alert').remove();
                            window.location.href = url;
                        }, 1000);
                    }
                },
                error: function (data) {
                    show_formAjax_error(data);
                }
            })
        }
    });

    $("#updateFuelTypes").validate({
        // rules
        rules: {
            name: "required",
        },
        // submit handler
        submitHandler: function(form) {
            $('.card .card-body').append('<div class="loader"></div>');
            var formdata = new FormData(form);
            var url = base_url+'/admin/fuelTypes';
            var id = $('input[name=id]').val();
            $.ajax({
                url : url+'/'+id,
                type : 'POST',
                data : formdata,
                cache: false,
                processData: false,
                contentType: false,
                success : function(dataResult){
                    if(dataResult == '1'){
                        $('body').append('<div class="response-alert alert alert-success">Updated Successfully.</div>');
                        setTimeout(function(){
                            $('.response-alert').remove();
                            window.location.href = url;
                        }, 1000);
                    }
                },
                error: function (data) {
                    show_formAjax_error(data);
                }
            })
        }
    });

    $(document).on("click", ".delete-fuelTypes", function() {
        destroy_post($(this),'fuelTypes/')
    });

    // ========================================
    // script for transmission module
    // ========================================

    // define columns
    cols = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex',sWidth:'20px'},
            {data: 'name', name: 'name'},
            {
                data: 'action',
                name: 'action',
                orderable: true,
                searchable: true,
                sWidth: '100px'
            },
        ];
    // show all reords
    load_dataTable('#transmission-list','transmission',cols);


    $("#add_transmission").validate({
        // rules
        rules: {
            name: "required",
        },
        // submit handler
        submitHandler: function(form) {
            $('.card .card-body').append('<div class="loader"></div>');
            var formdata = new FormData(form);
            var url = base_url+'/admin/transmission';
            $.ajax({
                url : url,
                type : 'POST',
                data : formdata,
                cache: false,
                processData: false,
                contentType: false,
                success : function(dataResult){
                    if(dataResult == '1'){
                        $('body').append('<div class="response-alert alert alert-success">Added Successfully.</div>');
                        setTimeout(function(){
                            $('.response-alert').remove();
                            window.location.href = url;
                        }, 1000);
                    }
                },
                error: function (data) {
                    show_formAjax_error(data);
                }
            })
        }
    });

    $("#updateTransmission").validate({
        // rules
        rules: {
            name: "required",
        },
        // submit handler
        submitHandler: function(form) {
            $('.card .card-body').append('<div class="loader"></div>');
            var formdata = new FormData(form);
            var url = base_url+'/admin/transmission';
            var id = $('input[name=id]').val();
            $.ajax({
                url : url+'/'+id,
                type : 'POST',
                data : formdata,
                cache: false,
                processData: false,
                contentType: false,
                success : function(dataResult){
                    if(dataResult == '1'){
                        $('body').append('<div class="response-alert alert alert-success">Updated Successfully.</div>');
                        setTimeout(function(){
                            $('.response-alert').remove();
                            window.location.href = url;
                        }, 1000);
                    }
                },
                error: function (data) {
                    show_formAjax_error(data);
                }
            })
        }
    });

    $(document).on("click", ".delete-transmission", function() {
        destroy_post($(this),'transmission/')
    });

    // ========================================
    // update general settings
    // ========================================

    $("#updateSetting").validate({
        rules: {
            site_name: { required: true },
            cont_email: { required: true },
            cont_phone: { required: true },
            cont_address: { required: true },
            cur_format: { required: true },
        },
        submitHandler: function(form) {
          $('.card .card-body').append('<div class="loader"></div>');
            var formdata = new FormData(form);
            var toUrl = base_url+'/admin/generalSetting';
            $.ajax({
                url: toUrl,
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success:function(dataResult){
                    console.log(dataResult);
                    if(dataResult == '1'){
                        $('body').append('<div class="response-alert alert alert-success">Updated Successfully.</div>');
                        setTimeout(function(){
                            $('.response-alert').remove();
                            window.location.href = toUrl;
                        }, 1000);
                    }
                },
                error: function (data) {
                    show_formAjax_error(data);
                }
            });
        }
    });

    // ========================================
    // Update social links 
    // ========================================

    $("#socialLinks").validate({
        submitHandler: function(form) {
          $('.card .card-body').append('<div class="loader"></div>');
            var formdata = new FormData(form);
            var toUrl = base_url+'/admin/socialNetworks';
            $.ajax({
                url: toUrl,
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success:function(dataResult){
                    if(dataResult){
                        $('body').append('<div class="response-alert alert alert-success">Updated Successfully.</div>');
                        setTimeout(function(){
                            $('.response-alert').remove();
                            window.location.href = toUrl;
                        }, 1000);
                    }
                },
                error: function (data) {
                    show_formAjax_error(data);
                }
            });
        }
    });

    // ========================================
    // update rental settings
    // ========================================

    $("#updateRentalSetting").validate({
        rules: {
            deposit_pay: { required: true },
            tax_pay: { required: true },
        },
        submitHandler: function(form) {
          $('.card .card-body').append('<div class="loader"></div>');
            var formdata = new FormData(form);
            var toUrl = base_url+'/admin/rentalSettings';
            $.ajax({
                url: toUrl,
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success:function(dataResult){
                    if(dataResult){
                        $('body').append('<div class="response-alert alert alert-success">Updated Successfully.</div>');
                        setTimeout(function(){
                            $('.response-alert').remove();
                            window.location.href = toUrl;
                        }, 1000);
                    }
                },
                error: function (data) {
                    show_formAjax_error(data);
                }
            });
        }
    });

    // ========================================
    // script for Users module
    // ========================================

    // show users list
    cols = [
        {data: 'DT_RowIndex', name: 'DT_RowIndex'},
        {data: 'name', name: 'name'},
        {data: 'email', name: 'email'},
        {data: 'phone', name: 'phone'},
        {data: 'created_at', name: 'join_date'},
        {
            data: 'action',
            name: 'action',
            orderable: true,
            searchable: true
        },
    ];
    load_dataTable('#users-list','all-users',cols);

    $(document).on('click','.userBlock',function(){
        var id = $(this).attr('data-id');
        var status = $(this).attr('data-status');
        if(status == '1'){
            status = '0';
        }else{
            status = '1';
        }
        $('.card .card-body').append('<div class="loader"></div>');
        $.ajax({
            url: base_url+'/admin/user/block',
            type: 'POST',
            data: {uId:id,status:status},
            success:function(dataResult){
                location.reload();
            }
        });
    })


    // ========================================    
    // script for Banner Slides module 
    // ========================================

        // load table
        cols = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'image'},
            {data: 'title'},
            {data: 'status'},
            {
                data: 'action',
                orderable: true, 
                searchable: true
            },
        ];
    load_dataTable('#banner-slides','banner-slider',cols)


    $("#add_slide").validate({
        rules: {
            title: { required: true },
            img: { required: true },
        },
        submitHandler: function(form) {
            $('.card .card-body').append('<div class="loader"></div>');
            var formdata = new FormData(form);
            var url = base_url+'/admin/banner-slider'
            $.ajax({
                url: url,
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success:function(dataResult){
                    if(dataResult == '1'){
                        $('body').append('<div class="response-alert alert alert-success">Added Successfully.</div>');
                        setTimeout(function(){
                            $('.response-alert').remove();
                            window.location.href = url;
                        }, 1000);
                    }else{
                        $('body').append('<div class="response-alert alert alert-danger">'+dataResult+'</div>');
                        setTimeout(function(){
                            $('.response-alert').remove();
                            window.location.reload();
                        }, 1000);
                    }
                },
                error: function (data) {
                    show_formAjax_error(data);
                }
            });
        }
    });

    $("#update_slide").validate({
        rules: {
            title: { required: true },
        },
        
        submitHandler: function(form) {
            $('.card .card-body').append('<div class="loader"></div>');
            var url = base_url+'/admin/banner-slider';
            var id = $('input[name=id]').val();
            var formdata = new FormData(form);
            $.ajax({
                url: url+'/'+id,
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success:function(dataResult){
                    console.log(dataResult);
                    if(dataResult == '1' || dataResult == '0'){
                        $('body').append('<div class="response-alert alert alert-success">Updated Successfully.</div>');
                        setTimeout(function(){
                            $('.response-alert').remove();
                            window.location.href = url;
                        }, 1000);
                    }
                },
                error: function (data) {
                    show_formAjax_error(data);
                }
            });
        }
    });

    $(document).on("click", ".delete-slide", function() {
        destroy_post($(this),'banner-slider/')
    });

    // ========================================    
    // script for Pages module 
    // ========================================

        // load table
        cols = [
            {data: 'DT_RowIndex', name: 'DT_RowIndex'},
            {data: 'title'},
            {data: 'status'},
            {
                data: 'action',
                orderable: true, 
                searchable: true
            },
        ];
    load_dataTable('#pages_list','pages',cols)


    $("#add_page").validate({
        rules: {
            title: { required: true },
            desc: { required: true },
        },
        submitHandler: function(form) {
            $('.card .card-body').append('<div class="loader"></div>');
            var formdata = new FormData(form);
            var url = base_url+'/admin/pages'
            $.ajax({
                url: url,
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success:function(dataResult){
                    if(dataResult == '1'){
                        $('body').append('<div class="response-alert alert alert-success">Added Successfully.</div>');
                        setTimeout(function(){
                            $('.response-alert').remove();
                            window.location.href = url;
                        }, 1000);
                    }else{
                        $('body').append('<div class="response-alert alert alert-danger">'+dataResult+'</div>');
                        setTimeout(function(){
                            $('.response-alert').remove();
                            window.location.reload();
                        }, 1000);
                    }
                },
                error: function (data) {
                    show_formAjax_error(data);
                }
            });
        }
    });

    $("#update_page").validate({
        rules: {
            title: { required: true },
            desc: { required: true },
        },
        
        submitHandler: function(form) {
            $('.card .card-body').append('<div class="loader"></div>');
            var url = base_url+'/admin/pages';
            var id = $('input[name=id]').val();
            var formdata = new FormData(form);
            $.ajax({
                url: url+'/'+id,
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                success:function(dataResult){
                    console.log(dataResult);
                    if(dataResult == '1' || dataResult == '0'){
                        $('body').append('<div class="response-alert alert alert-success">Updated Successfully.</div>');
                        setTimeout(function(){
                            $('.response-alert').remove();
                            window.location.href = url;
                        }, 1000);
                    }
                },
                error: function (data) {
                    show_formAjax_error(data);
                }
            });
        }
    });

    $(document).on("click", ".delete-page", function() {
        destroy_post($(this),'pages/')
    });


});
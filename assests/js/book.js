
$(document).ready(function()
{
	$("#table_id").DataTable(); 
});



$(function()
  {
    $('#country').change(function()
    {
      var country_id = $('#country').val();
      if(country_id != '')
      {
        $.ajax({
          url : "book/state",
          method: "POST",

          data:{c_id:country_id},
          success:function(data)
          {
            $("#state").html(data);
          }
        })
      }
      else
      {
        $('#state').html('<option value="">Select State</option>');
      }
    });

    $('#state').change(function()
    {
      var state_id = $('#state').val();
      if(state_id != '')
      {
        $.ajax({
          url : "book/city",
          method: "POST",
          data: {s_id:state_id},
          success:function(data)
          {
            $("#city").html(data);
          }
        })
      }
      else
      {
        $('#city').html('<option value="">Select City</option>');
      }
    });
});

var save_method; //for save method string
var table;

    function add_country()
    {
      $.ajax({
        url : "book/find_country",
        type: "GET",
        dataType: "JSON", 
        success:function(data)
        {
          $("#country").html(data);
        }
      });    
    }

    function add_book()
    {
      save_method = 'add'; 
      $('#form')[0].reset(); // reset form on modals 
      $('#modal_form').modal('show'); // show bootstrap modal
      add_country();   
    }

    function edit_book(id)
    {
      save_method = 'update';
      $('#form')[0].reset(); // reset form on modals

      //Ajax Load data from ajax
      $.ajax({
        url : "book/ajax_edit/" + id,
        type: "POST",
        dataType: "JSON",
        success: function(data)
        {
            $('[name="id"]').val(data.id);
            $('[name="fname"]').val(data.fname);
            $('[name="lname"]').val(data.lname);
            $('[name="age"]').val(data.age);
            $('[name="dob"]').val(data.dob);
            $('[name="mobile"]').val(data.mobile);
            $('[name="email"]').val(data.email);
            $('[name="add1"]').val(data.add1);
            $('[name="add2"]').val(data.add2);
            $('[name="pincode"]').val(data.pincode);        
            add_country();

            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Edit Information'); // Set title to Bootstrap modal title

        },
        error: function ()
        {
            alert('Error get data from ajax');
        }
    });
    }

    function save()
    {
      var url;
      var msg;
      if(save_method == 'add')
      {
          	url = "book/book_add";
          	msg = "some error in add book";
      }
      else
      {
        	url = "book/book_update";
        	msg = "some error in edit book";
      }
       // ajax adding data to database
          $.ajax({
            url : url,
            type: "POST",
            data: $("#form").serialize(),
            //data: new FormData(this),
            dataType: "JSON",
            success: function(data)
            {
               //if success close modal and reload ajax table
               $('#modal_form').modal('hide');
                location.reload();// for reload a page
            },
            error: function ()
            {
                alert(msg);
            }
          }); 
    }

    function delete_book(id)
    {
      if(confirm('Are you sure delete this data?'))
      {
        // ajax delete data from database
          $.ajax({
            url : "book/book_delete/"+id,
            type: "POST",
            dataType: "JSON",
            success: function(data)
            {              
               location.reload();
            },
            error: function ()
            {
                alert('Error deleting data');
            }
        });

      }
    }


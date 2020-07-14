<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<!-- Popper JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<!-- <script src="http://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script> -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url('assets/js/wow.min.js') ?>"></script>
<!-- <script src="<?php echo base_url('assets/js/slick.js') ?>"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
<script src="<?php echo base_url('assets/js/easy-responsive-tabs.js') ?>"></script>
<script src="<?php echo base_url('assets/js/jquery.fancybox.min.js') ?>"></script>
<script src="<?php echo base_url('assets/js/custom.js') ?>"></script>
<script src="<?php echo base_url('assets/js/cleave.min.js') ?>"></script>
<script src="<?php echo base_url('assets/js/cleave-phone.us.js') ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

<script type="text/javascript">
    $(function () {
    
        $("#datepicker").datepicker({
            defaultDate: null,
    
            format: "dd-mm-yyyy",
    
            autoclose: true,
    
            todayHighlight: true,
    
            endDate: '+0d',
    
            // startDate: new Date('1-1-1990')
    
        }).datepicker('update', new Date());
    
        $("#datepicker2").datepicker({
            defaultDate: null,
    
            autoclose: true,
    
            todayHighlight: true,
    
            endDate: '+0d',
    
            // startDate: new Date('1-1-1990')
    
        });
    
    });
</script>

<?php include('easter.php');  ?>

<script type="text/javascript">
    function readURL1(input) {
    
        if (input.files && input.files[0]) {
    
            var reader = new FileReader();
    
            reader.onload = function (e) {
    
                $('.neimg_cls').hide();
    
                $('.image-upload-wrap').hide();
    
                $('.file-upload-image').attr('src', e.target.result);
    
                $('.file-upload-content').show();
    
                $('.image-title').html(input.files[0].name);
    
            };
    
            reader.readAsDataURL(input.files[0]);
    
        } else {
    
            removeUpload1();
    
        }
    
    }
    
    function removeUpload1() {
    
        $('.file-upload-input1').replaceWith($('.file-upload-input1').clone());
    
        $('.file-upload-content').hide();
    
        $('.image-upload-wrap').show();

        $('.file-upload').removeClass('file-uploaded');
    
    }
    
    $('.image-upload-wrap').bind('dragover', function () {
    
        $('.image-upload-wrap').addClass('image-dropping');
    
    });
    
    $('.image-upload-wrap').bind('dragleave', function () {
    
        $('.image-upload-wrap').removeClass('image-dropping');
    
    });
    
    
    
    /* Upload sec 2 */
    
    function readURL2(input) {
    
        if (input.files && input.files[0]) {
    
            var reader = new FileReader();
    
            reader.onload = function (e) {
    
                $('.neimg_cls2').hide();
    
                $('.image-upload-wrap').hide();
    
                $('.file-upload-image2').attr('src', e.target.result);
    
                $('.file-upload-content2').show();
    
                $('.image-title2').html(input.files[0].name);
    
            };
    
            reader.readAsDataURL(input.files[0]);
    
        } else {
    
            removeUpload2();
    
        }
    
    }
    
    function removeUpload2() {
    
        $('.file-upload-input2').replaceWith($('.file-upload-input2').clone());
    
        $('.file-upload-content2').hide();
    
        $('.image-upload-wrap').show();
    
    }
    
    $('.image-upload-wrap').bind('dragover', function () {
    
        $('.image-upload-wrap').addClass('image-dropping');
    
    });
    
    $('.image-upload-wrap').bind('dragleave', function () {
    
        $('.image-upload-wrap').removeClass('image-dropping');
    
    });
</script>

<script>
    if($('.cleave-input-phone').length > 0){
        var cleave = new Cleave('.cleave-input-phone', {
            phone: true,
            phoneRegionCode: 'us'
        });
    }
</script>


<script>
    if(window.location.hash){
        if($(window.location.hash).length > 0){
            $(window.location.hash).addClass('shadow');
            $('html, body').animate({
                scrollTop: $(window.location.hash).offset().top
            }, 2000);
        }
    }
</script>


<script
    src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key=AIzaSyA3-pecaK5H2_enOKnleuDJchGBWykDvw4">
</script>
<!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA3-pecaK5H2_enOKnleuDJchGBWykDvw4&amp;libraries=places&amp;callback=initAutocomplete" async="" defer=""></script> -->
<script>
var componentForm = {
    street_number: 'short_name',
    route: 'long_name',
    locality: 'long_name',
    administrative_area_level_1: 'short_name',
    country: 'long_name',
    postal_code: 'short_name'
};

$(document).ready(function() {

    if($('#street_address').length > 0){
        var autocomplete;
        autocomplete = new google.maps.places.Autocomplete((document.getElementById('street_address')), {
            types: ['geocode'],
            componentRestrictions: {
                country: "USA"
            }
        });

        autocomplete.setFields(['address_component']);

        google.maps.event.addListener(autocomplete, 'place_changed', function() {
            var place = autocomplete.getPlace();

            $('#street_address').val(place.address_components[0].short_name+' '+place.address_components[1].short_name);

            for (var i = 0; i < place.address_components.length; i++) {
                console.log(place.address_components[i]);
                
                var addressType = place.address_components[i].types[0];


                if (addressType == 'locality') {
                    $('#city').val(place.address_components[i].long_name);
                    console.log("locality");
                }

                if (addressType == 'administrative_area_level_1') {
                    $("#state option").each(function() {
                        if ($(this).data('code') == place.address_components[i].short_name) {
                            $(this).attr("selected", "selected");
                        }
                    });
                }

                if (addressType == 'postal_code') {
                    $('#postal_code').val(place.address_components[i].long_name)
                    console.log("postal_code");
                }

            }
        });
    }
});
</script>


<script>
// Example starter JavaScript for disabling form submissions if there are invalid fields
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
            
        }
        form.classList.add('was-validated');
        if($(".invalid-feedback:visible").length > 0){
            $([document.documentElement, document.body]).animate({
                scrollTop: $(".invalid-feedback:visible").offset().top - 75
            }, 750);
        }
      }, false);
    });
  }, false);
})();
</script>

<script>
    function validate(evt) {
        var theEvent = evt || window.event;

        // Handle paste
        if (theEvent.type === 'paste') {
            key = event.clipboardData.getData('text/plain');
        } else {
        // Handle key press
            var key = theEvent.keyCode || theEvent.which;
            key = String.fromCharCode(key);
        }
        var regex = /[0-9]|\./;
        if( !regex.test(key) ) {
            theEvent.returnValue = false;
            if(theEvent.preventDefault) theEvent.preventDefault();
        }
    }
</script>

<?php if($this->session->userdata('user_id')): ?>
    <?php if($user->role_id == 4): ?>
        <?php if(!$this->user->is_password_updated_consumer($user->user_id)): ?>
        <?php include('password_update.php'); ?>
        <?php endif; ?>
    <?php endif; ?>
<?php endif; ?>

<?php if($this->session->flashdata('success')): ?>
<script>
Swal.fire(
    'Good job!',
    '<?php echo $this->session->flashdata('success') ?>',
    'success'
)
</script>
<?php endif; ?>

<?php if($this->session->flashdata('error')): ?>
<script>
console.log(<?php echo $this->session->flashdata('error') ?>);
</script>
<?php endif; ?>
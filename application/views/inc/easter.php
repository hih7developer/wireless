<style>
.easter-egg-container-class div#swal2-content {
    color: #00a69c;
}
.easter-egg-container-class button.swal2-confirm{
    border-left-color: #00a69c;
    border-right-color: #00a69c;
    background: #00a69c;
    padding: 5px 15px;
    font-size: 14px;
}
</style>
<script>
    $(document).on('keyup', '.3000', function(){
        var egg = $(this).val();
        if(egg == 'wireless@easter.egg'){
            Swal.fire({
                text: 'Developed by Sudipta, Sutanu, Design by Poulumi, Arnab.',
                customClass: {
                    container: 'easter-egg-container-class',
                }
            });
        }
    });
</script>
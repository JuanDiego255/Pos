<script>

    function load_orders() {
        $.ajax({
            url         : "{{ route('admin.load_kitchen_orders') }}",
            method      : "POST",
            data        : {
                '_token': "{{ csrf_token() }}"
            },
            success     : function(r){
                if (!r.status) {
                    toast_msg(r.msg, r.type);
                    return;
                }

                $('#wrapper-kitchen').html(r.html);
            },
            dataType    : "json"
        });
    }

    $('body').on('click', '.btn-change-status', function() {
        event.preventDefault();
        let iddetalle       = $(this).data('iddetalle'),
            idproducto      = $(this).data('idproducto'),
            idorden         = $(this).data('idorden');

            $.ajax({
                url             : "{{ route('admin.change_status_product_kitchen') }}",
                method          : "POST",
                data            : {
                    '_token'    : "{{ csrf_token() }}",
                    iddetalle   : iddetalle,
                    idproducto  : idproducto,
                    idorden     : idorden
                },
                beforeSend  : function(){
                    block_content('#layout-content');
                },
                success         : function(r){
                    if (!r.status) {
                        close_block('#layout-content');
                        toast_msg(r.msg, r.type);
                        return;
                    }

                    close_block('#layout-content');
                    toast_msg(r.msg, r.type);
                    load_orders();
                },
                dataType        : "json"
            });
    });

    const cargarSonido = function (fuente) {
        const sonido = document.createElement("audio");
        sonido.src = fuente;
        sonido.setAttribute("preload", "auto");
        sonido.setAttribute("controls", "none");
        sonido.style.display = "none"; // <-- oculto
        document.body.appendChild(sonido);
        return sonido.play();
    };

    $(document).ready(function() {
        load_orders();
        Echo.channel('update-kitchen').listen('UpdateKitchenEvent', (e) => {
            load_orders();
            cargarSonido("mp3/notification.mp3");
            setTimeout(() => {
                cargarSonido("mp3/notification.mp3");
            }, 2000);
        });

        Echo.channel('update-kitchen-finish').listen('UpdateKitchenFinishEvent', (e) => {
            load_orders();
        });
    });
</script>
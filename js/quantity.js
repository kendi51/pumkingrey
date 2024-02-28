

// $(document).ready(function () {
//     var price = $('.price').val();

    
//     $('.plus-btn').click(function (e) { 
//         e.preventDefault();

//         var qty = $(this).closest('.quantity').find('.qty-input').val();

//         var value = parseInt(qty,10);

//         value = isNaN(value) ? 0 : value;

//         if(value < 10) {
//             value++;

//             $(this).closest('.quantity').find('.qty-input').val(value);
//         }
//     });

//     $('.minus-btn').click(function (e) { 
//         e.preventDefault();

//         var qty = $(this).closest('.quantity').find('.qty-input').val();

//         var value = parseInt(qty,10);

//         value = isNaN(value) ? 1 : value;

//         if(value > 1) {
//             value--;

//             $(this).closest('.quantity').find('.qty-input').val(value);
//         }
//     });
// });
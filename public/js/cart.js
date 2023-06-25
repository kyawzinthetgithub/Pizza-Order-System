$(document).ready(function() {
            //add more
            $('.btn-plus').click(function() {

                $parentNode = $(this).parents('tr');
                $price = Number($parentNode.find('#price').text().replace("Kyats", ""));
                $qty = Number($parentNode.find('.qty').val());

                $total = $price * $qty;
                $parentNode.find('#total').html($total);

                //total summary
                summeryCalculation();

            });

            //reduce pizza
            $('.btn-minus').click(function() {

                $parentNode = $(this).parents('tr');
                $price = Number($parentNode.find('#price').text().replace("Kyats", ""));
                $qty = Number($parentNode.find('.qty').val());

                $total = $price * $qty;
                $parentNode.find('#total').html($total);

                //total summary
                summeryCalculation();
            });


            // final price for order
            function summeryCalculation() {
                $totalPrice = 0;
                $('#dataTable tr').each(function(index, row) {
                    $totalPrice += Number($(row).find('#total').text());
                });

                $('#subTotalPrice').html($totalPrice);
                $('#finalPrice').html($totalPrice + 3000);
            };
        });

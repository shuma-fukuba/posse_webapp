<script type="text/javascript">
window.onload = () => {
    $(function () {
        $('#open-modal').on('click', function () {
            $('.modal').fadeIn();
            return false;
        });
        $('.close-modal').on('click', function () {
            $('.modal').fadeOut();
            return false;
        });
    });

    // let languageCircle = document.getElementById('language');
    // let language = new Chart(languageCircle, {
    //     type: 'doughnut',
    //     data: {
    //         datasets: [
    //             {
    //                 backgroundColor: [
    //                     'rgb(3, 69, 236)',
    //                     'rgb(15, 113, 189)',
    //                     'rgb(32, 189, 222)',
    //                     'rgb(60, 206, 254)',
    //                     'rgb(178, 158, 243)',
    //                     'rgb(109, 70, 236)',
    //                     'rgb(74, 23, 239)',
    //                     'rgb(49, 5, 192)',
    //                 ],
    //                 data: <?= $language_value; ?>,
    //             }
    //         ],
    //     },
    //     options: {
    //         responsive: true,
    //     },
    // });

    // let contentCircle = document.getElementById('content-circle');
    // let content = new Chart(contentCircle, {
    //     type: 'doughnut',
    //     data: {
    //         datasets: [
    //             {
    //                 backgroundColor: [
    //                     'rgb(3, 69, 236)',
    //                     'rgb(15, 113, 189)',
    //                     'rgb(32, 189, 222)',
    //                 ],
    //                 data: <?= $content_value; ?>,
    //             }
    //         ],
    //     },
    //     options: {
    //         responsive: true,
    //     },
    // });
}
</script>

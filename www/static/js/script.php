<script src="chart.php" type="text/javascript"></script>
<script type="text/javascript">
let languageCircle = document.getElementById('language');
    let language = new Chart(languageCircle, {
        type: 'doughnut',
        data: {
            labels: ['HTML', 'CSS', 'JavaScript', 'PHP', 'Laravel', 'SQL', 'SHELL', '情報システム基礎知識(その他)'],

            datasets: [{
                backgroundColor: [
                    'rgb(3, 69, 236)',
                    'rgb(15, 113, 189)',
                    'rgb(32, 189, 222)',
                    'rgb(60, 206, 254)',
                    'rgb(178, 158, 243)',
                    'rgb(109, 70, 236)',
                    'rgb(74, 23, 239)',
                    'rgb(49, 5, 192)',
                ],
                data: [42, 18, 10, 8, 7, 6, 5, 4]
            }],
        }
    });
</script>

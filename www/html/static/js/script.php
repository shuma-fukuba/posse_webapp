<script type="text/javascript">
    window.onload = () => {
        $(function() {
            $('#open-modal').on('click', function() {
                $('.modal').fadeIn();
                return false;
            });
            $('.close-modal').on('click', function() {
                $('.modal').fadeOut();
                return false;
            });
            $('#phone-open-modal').on('click', function() {
                $('.modal').fadeIn();
                return false;
            });
        });

        let languageCircle = document.getElementById('language');
        let language = new Chart(languageCircle, {
            type: 'doughnut',
            data: {
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
                    data: <?= $languages_value ?>,
                }],
            },
            options: {
                responsive: true,
            },
        });

        let contentCircle = document.getElementById('content-circle');
        let content = new Chart(contentCircle, {
            type: 'doughnut',
            data: {
                datasets: [{
                    backgroundColor: [
                        'rgb(3, 69, 236)',
                        'rgb(15, 113, 189)',
                        'rgb(32, 189, 222)',
                    ],
                    data: <?= $contents_value ?>,
                }],
            },
            options: {
                responsive: true,
            },
        });

        const barGraph = document.getElementById('bar');
        let ctx = barGraph.getContext('2d');
        let gradient = ctx.createLinearGradient(0, 0, 0, 1000);
        gradient.addColorStop(0, 'rgb(59, 204, 254)');
        gradient.addColorStop(1, 'rgb(17, 117, 191)');
        const bar = new Chart(barGraph, {
            type: 'bar',
            data: {
                datasets: [{
                    data: [
                        <?php foreach ($bar as $data) : ?> {
                                x: '<?= $data['learning_date'] ?>',
                                y: <?= $data['time'] ?>
                            },
                        <?php endforeach; ?>
                    ],
                    backgroundColor: gradient,
                    borderRadious: '20px',
                    fill: false,
                }],
            },

            options: {
                plugins: {
                    legend: {
                        display: false,
                    },
                },
            },
            scales: {
                xAxes: {
                    type: 'time',
                    time: {
                        unit: 'day',
                        displayFormats: {
                            day: 'DD'
                        },
                        unitStepSize: 2
                    },
                    scaleLabel: {

                    },
                    gridLines: {
                        display: false,
                    },
                    ticks: {

                    }
                },
                yAxes: {
                    scaleLabel: {

                    },
                    gridLines: {
                        display: false,
                    },
                    ticks: {

                    }
                }

            }
        });
    }
</script>

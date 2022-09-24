const ctx = document.getElementById('chart-docente').getContext('2d');
const myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
        datasets: [
            {
                label: '# of Votes',
                data: [12, 19, 3, 5, 2, 3],
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                fill: true
            },
            {
                label: '# of Votes',
                data: [19, 3, 12, 2, 3, 5],
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                fill: true
            },
            {
                label: '# of Votes',
                data: [5, 3, 12, 19, 3, 5],
                backgroundColor: 'rgba(255, 206, 86, 0.2)',
                borderColor: 'rgba(255, 206, 86, 1)',
                fill: true
            },
            {
                label: '# of Votes',
                data: [3, 3, 12, 2, 19, 5],
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                fill: true
            },
            {
                label: '# of Votes',
                data: [2, 3, 19, 3, 12, 5],
                backgroundColor: 'rgba(153, 102, 255, 0.2)',
                borderColor: 'rgba(153, 102, 255, 1)',
                fill: true
            },
            {
                label: '# of Votes',
                data: [12, 3, 5, 2, 3, 19],
                backgroundColor: 'rgba(255, 159, 64, 0.2)',
                borderColor: 'rgba(255, 159, 64, 1)',
                fill: true
            }
        ]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: true
            }
        },
        elements: {
            line: {
                borderWidth: 1.5,
                cubicInterpolationMode: 'monotone',
                tension: 0.4
            },
            point: {
                pointStyle: 'circle',
                pointRadius: 4
            }
        }
    }
});
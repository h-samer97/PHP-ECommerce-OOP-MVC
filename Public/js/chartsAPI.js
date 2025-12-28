export default class API {

    constructor() {}

    analiysRating() {

        fetch('api/analiysRating').then(res => res.json())
        .then(rows => {
            const labels = rows.map(r => r.Rating);
            const data = rows.map(r => r.total);
            const canvas = document.getElementById('analiysRating');
                if (!canvas) return console.error("Canvas #charts not found");
                const ctx = canvas.getContext('2d');

            new Chart(ctx, {

                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Analiys Rating',
                        data: data,
                         borderWidth: 2,
                        // fill: true,
                        tension: 0.3
                    }]
                },
                options: {
                        responsive: true,
                        animation: { duration: 1000, easing: 'easeOutQuart' },
                        plugins: {
                            title: {
                                // display: true,
                                text: 'Data Analiys Rating',
                                // font: { size: 18, weight: 'bold' },
                                color: '#000000ff',
                                padding: { bottom: 10 }
                            }
                        },
                        scales: {
                            y: {
                                // beginAtZero: true,
                            },
                            x: {}
                        }
                    }


            });

        })

    }

    renderUsersDatesChart() {
        fetch('api/getUsersWithDates')
            .then(res => res.json())
            .then(rows => {
                const labels = rows.map(r => r.year);
                const data = rows.map(r => Number(r.count));
                console.log(labels, data)
                const canvas = document.getElementById('charts');
                if (!canvas) return console.error("Canvas #charts not found");
                const ctx = canvas.getContext('2d');

                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Number of users per year',
                            data: data,
                            backgroundColor: 'rgba(0, 123, 255, 0.6)',
                            borderColor: 'rgba(0, 123, 255, 1)',
                            borderWidth: 2,
                            fill: true,
                            tension: 0.3
                        }]
                    },
                    options: {
                        responsive: true,
                        animation: { duration: 1000, easing: 'easeOutQuart' },
                        plugins: {
                            title: {
                                // display: true,
                                text: 'User registration statistics by year',
                                // font: { size: 18, weight: 'bold' },
                                color: '#000000ff',
                                padding: { bottom: 10 }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                            },
                            x: {}
                        }
                    }
                });
            })
            .catch(err => console.error("Error fetching yearly data:", err));
    }

    monthlyRegistrationCount() {
        const canvas = document.getElementById('monthlyChart');
        if (!canvas) return console.error("Canvas #monthlyChart not found");
        const ctx = canvas.getContext('2d');

        fetch('api/monthlyRegistrationCount')
            .then(res => res.json())
            .then(data => {
                
                const chartData = new Array(12).fill(0);

                data.forEach(row => {
                    if (row.month && row.registrations) {
                        chartData[row.month - 1] = row.registrations;
                    }
                });

                new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
                        datasets: [{
                            label: 'User Registrations',
                            data: chartData,
                            borderWidth: 1
                        }]
                    },
                    options: { 
                        responsive: true,
                        animation: { duration: 1000, easing: 'easeOutQuart' },
                        plugins: {
                            title: {
                                text: 'Monthly User Registration Breakdown',
                            },
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                            },
                            x: {}
                        }
                    }
                });
            })
            .catch(err => console.error("Error fetching monthly data:", err));
    }

    searchBox() {
        const searchBoxField = document.querySelector('#searchBox');
        const searchBoxFieldItem = document.querySelector('.sb-resultes');
        let Timer;

        if (!searchBoxField || !searchBoxFieldItem) return;

        searchBoxField.addEventListener('keyup', () => {
            const query = searchBoxField.value.trim();
            clearTimeout(Timer);

            if (query.length > 2) {
                Timer = setTimeout(() => {
                    fetch('api/searchData?q=' + encodeURIComponent(query))
                        .then(res => res.json())
                        .then(data => {
                            searchBoxFieldItem.innerHTML = '';

                            if (data.users.length === 0 && data.categories.length === 0 && data.items.length === 0) {
                                searchBoxFieldItem.innerHTML = '<div class="result-item">No Result</div>';
                                return;
                            }

                            data.users.forEach(user => {
                                const div = document.createElement('div');
                                const anchor = document.createElement('a');
                                div.className = 'result-item';
                                 div.appendChild(document.createTextNode('[Members] '));
                                
                                anchor.href = 'members/' + encodeURIComponent(user.UserID) + '/edit';
                                anchor.textContent = user.Username;
                                anchor.target = '_self';

                                div.appendChild(anchor);
                                searchBoxFieldItem.appendChild(div);
                            });

                            data.categories.forEach(cat => {
                                const div = document.createElement('div');
                                const anchor = document.createElement('a');

                                div.className = 'result-item';

                                div.appendChild(document.createTextNode('[Category] '));
                                
                                anchor.href = 'categories/' + encodeURIComponent(cat.ID) + '/edit';
                                anchor.textContent = cat.Name;
                                anchor.target = '_self';

                                div.appendChild(anchor);
                                searchBoxFieldItem.appendChild(div);
                            });

                            data.items.forEach(item => {
                                const div = document.createElement('div');
                                const anchor = document.createElement('a');
                                div.className = 'result-item';
                                div.appendChild(document.createTextNode('[Item] '));
                                
                                anchor.href = 'items/' + encodeURIComponent(item.Item_id) + '/edit';
                                anchor.textContent = item.Item_name;
                                anchor.target = '_self';

                                div.appendChild(anchor);
                                searchBoxFieldItem.appendChild(div);
                            });
                        });
                }, 300);
            } else {
                searchBoxFieldItem.innerHTML = '';
            }
        });
    }

    // دالة البحث الثنائي
    // هذه الدالة تجريبية قد يتم تفعيلها على مربع البحث لاحقا
    binarySearch(array, target) {
        let first = 0;
        let last = array.length - 1;

        while (first <= last) {
            const mid = Math.floor((first + last) / 2);
            if (array[mid] === target) return array[mid];
            else if (array[mid] < target) first = mid + 1;
            else last = mid - 1;
        }

        return -1;
    }

    analiysApprovedItems() {
        fetch('api/analiysApprovedItems').then(res => res.json())
        .then(rows => {
            const labels = rows.map(r => r.Approve);
            const data = rows.map(r => r.total);
            const canvas = document.getElementById('d-pie');
                if (!canvas) return console.error("Canvas #charts not found");
                const ctx = canvas.getContext('2d');

            new Chart(ctx, {

                type: 'doughnut',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Analiys Rating',
                        data: data,
                         borderWidth: 2,
                        // fill: true,
                        tension: 0.3
                    }]
                },
                options: {
                        responsive: true,
                        animation: { duration: 1000, easing: 'easeOutQuart' },
                        plugins: {
                            title: {
                                display: true,
                                text: 'Data Analiys Rating',
                                // font: { size: 18, weight: 'bold' },
                                color: '#000000ff',
                                padding: { bottom: 10 }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                            },
                            x: {}
                        }
                    }


            });

        })
    }

    getTotalItemsInCats() {
        fetch('api/getTotalItemsInCats').then(res => res.json())
        .then(rows => {
            const labels = rows.map(r => r.Category);
            const data = rows.map(r => r.total_items);
            const canvas = document.getElementById('d-line');
                if (!canvas) return console.error("Canvas #charts not found");
                const ctx = canvas.getContext('2d');

            new Chart(ctx, {

                type: 'pie',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Get Total Items In Cats',
                        data: data,
                         borderWidth: 2,
                        // fill: true,
                        tension: 0.3
                    }]
                },
                options: {
                        responsive: true,
                        animation: { duration: 1000, easing: 'easeOutQuart' },
                        plugins: {
                            title: {
                                display: true,
                                text: 'Get Total Items In Cats',
                                // font: { size: 18, weight: 'bold' },
                                color: '#000000ff',
                                padding: { bottom: 10 }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                            },
                            x: {}
                        }
                    }


            });

        })
    }
}
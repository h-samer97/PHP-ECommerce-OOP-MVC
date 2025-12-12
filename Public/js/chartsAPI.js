export default class API {

    constructor() {
        const x = this.binarySearch([1,2,3,4,5,6,7,8,9,10,11,12,13,14,15], 4);
        console.log("Binary search result:", x);
    }

    renderUsersDatesChart() {
        fetch('/api/getUsersWithDates')
            .then(res => res.json())
            .then(rows => {
                const labels = rows.map(r => r.year);
                const data = rows.map(r => Number(r.count));

                const canvas = document.getElementById('charts');
                if (!canvas) return console.error("Canvas #charts not found");
                const ctx = canvas.getContext('2d');

                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels,
                        datasets: [{
                            label: 'Number of users per year',
                            data,
                            backgroundColor: 'rgba(0, 123, 255, 0.6)',
                            borderColor: 'rgba(0, 123, 255, 1)',
                            borderWidth: 2,
                            fill: true,
                            tension: 0.3
                        }]
                    },
                    options: {
                        responsive: true,
                        layout: { padding: { top: 20, bottom: 20 } },
                        animation: { duration: 1000, easing: 'easeOutQuart' },
                        plugins: {
                            title: {
                                display: true,
                                text: 'User registration statistics by year',
                                font: { size: 18, weight: 'bold' },
                                color: '#fff',
                                padding: { bottom: 10 }
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: { stepSize: 1, color: '#ccc' },
                                grid: { color: 'rgba(255,255,255,0.1)' }
                            },
                            x: {
                                ticks: { color: '#ccc' },
                                grid: { color: 'rgba(255,255,255,0.1)' }
                            }
                        }
                    }
                });
            })
            .catch(err => console.error("Error fetching yearly data:", err));
    }

    // تم حذف دالة renderCatsAPI بناءً على طلبك

    monthlyRegistrationCount() {
        const canvas = document.getElementById('monthlyChart');
        if (!canvas) return console.error("Canvas #monthlyChart not found");
        const ctx = canvas.getContext('2d');

        fetch('/api/monthlyRegistrationCount')
            .then(res => res.json())
            .then(data => {
                // الإصلاح الجوهري: تحويل البيانات من كائنات ({month: X, registrations: Y}) إلى مصفوفة أرقام ([...])
                // مصفوفة من 12 خانة (لتمثيل شهور السنة) مبدئياً أصفار
                const chartData = new Array(12).fill(0);

                // توزيع البيانات القادمة من السيرفر على المصفوفة (شهر 1 -> فهرس 0)
                data.forEach(row => {
                    // التحقق للتأكد من وجود البيانات
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
                            data: chartData, // <--- استخدام المصفوفة المصححة
                            backgroundColor: 'rgba(75,192,192,0.6)',
                            borderColor: '#4bc0c0',
                            borderWidth: 1
                        }]
                    },
                    options: { // خيارات محسنة لتحسين شكل الرسم
                        responsive: true,
                        layout: { padding: { top: 20, bottom: 20 } },
                        animation: { duration: 1000, easing: 'easeOutQuart' },
                        plugins: {
                            title: {
                                display: true,
                                text: 'Monthly User Registration Breakdown',
                                font: { size: 18, weight: 'bold' },
                                color: '#fff',
                                padding: { bottom: 10 }
                            },
                            tooltip: { mode: 'index', intersect: false }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: { stepSize: 1, color: '#ccc' }, 
                                grid: { color: 'rgba(255,255,255,0.1)' }
                            },
                            x: {
                                ticks: { color: '#ccc' },
                                grid: { color: 'rgba(255,255,255,0.1)' }
                            }
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
                    fetch('/api/searchData?q=' + encodeURIComponent(query))
                        .then(res => res.json())
                        .then(data => {
                            searchBoxFieldItem.innerHTML = '';

                            if (data.users.length === 0 && data.categories.length === 0 && data.items.length === 0) {
                                searchBoxFieldItem.innerHTML = '<div class="result-item">No Result</div>';
                                return;
                            }

                            data.users.forEach(user => {
                                const div = document.createElement('div');
                                div.className = 'result-item';
                                div.textContent = `[User] ${user.Username}`;
                                searchBoxFieldItem.appendChild(div);
                            });

                            data.categories.forEach(cat => {
                                const div = document.createElement('div');
                                div.className = 'result-item';
                                div.textContent = `[Category] ${cat.Name}`;
                                searchBoxFieldItem.appendChild(div);
                            });

                            data.items.forEach(item => {
                                const div = document.createElement('div');
                                div.className = 'result-item';
                                div.textContent = `[Item] ${item.Item_name}`;
                                searchBoxFieldItem.appendChild(div);
                            });
                        });
                }, 300);
            } else {
                searchBoxFieldItem.innerHTML = '';
            }
        });
    }

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
}
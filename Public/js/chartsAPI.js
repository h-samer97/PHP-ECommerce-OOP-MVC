export default class API {

    constructor() {

        var x = this.binarySearch([1,2,3,4,5,6,7,8,9,10,11,12,13,14,15], 4);
        console.log(x);

    }

    renderUsersDatesChart() {
                    fetch('/api/getUsersWithDates')
            .then(res => res.json())
            .then(rows => {
                const labels = rows.map(r => r.year);         // السنوات
                const data = rows.map(r => Number(r.count));  // عدد المستخدمين

                const ctx = document.getElementById('charts').getContext('2d');
                new Chart(ctx, {
                type: 'line',
                data: {
                    labels,
                    datasets: [{
                    label: 'عدد المستخدمين لكل سنة',
                    data,
                    backgroundColor: 'rgba(0, 54, 90, 0.5)',
                    borderColor: 'rgba(0, 102, 170, 1)',
                    borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                    title: {
                        display: true,
                        text: 'إحصائية تسجيل المستخدمين حسب السنة'
                    }
                    },
                    scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { stepSize: 1 }
                    }
                    }
                }
                });
            });

        }

        renderCatsAPI() {
                fetch('api/getCats')
                    .then(response => {
                    if (!response.ok) throw new Error(`HTTP error! status: ${response.status}`);
                    return response.json();
                    })
                    .then(data => {
                    if (!Array.isArray(data) || data.length === 0) {
                        console.warn("No data available for chart.");
                        return;
                    }

                    const labels = data.map(item => item.Name);
                    const counts = data.map(item => item.ItemCount);

                    const ctx = document.getElementById('categoryChart').getContext('2d');

                    new Chart(ctx, {
                        type: 'bar',
                        data: {
                        labels: labels,
                        datasets: [{
                            label: 'عدد العناصر حسب الفئة',
                            data: counts,
                            backgroundColor: 'rgba(54, 162, 235, 0.6)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1
                        }]
                        },
                        options: {
                        responsive: true,
                        scales: {
                            y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'عدد العناصر'
                            }
                            },
                            x: {
                            title: {
                                display: true,
                                text: 'الفئة'
                            }
                            }
                        },
                        plugins: {
                            title: {
                            display: true,
                            text: 'إحصائية عدد العناصر حسب الفئة'
                            }
                        }
                        }
                    });
                    })
                    .catch(error => {
                    console.error("Error rendering chart:", error);
                    });
        }

        binarySearch(array, target) {

            var first = 0;
            var last = array.length - 1;

            while( first <= last ) {

                var mid = Math.floor( (first + last) / 2 );
                console.log(mid);

                if(array[mid] == target) {
                    return array[mid];
                } else if(array[mid] < target) {
                    first = mid + 1;
                } else {
                    last = mid - 1;
                }

            }

            return -1;

        }

    searchBox() {

        let searchBoxFeild = document.querySelector('#searchBox');
        let Timer;
        let searchBoxFeildItem = document.querySelector('.sb-resultes');

        if (!searchBoxFeild) return;
        
        searchBoxFeild.addEventListener('keyup', () => {
                var query = searchBoxFeild.value.trim();
                clearTimeout(Timer);

                if (query.length > 2) {
                    Timer = setTimeout(() => {
                        fetch('api/searchData?q=' + encodeURIComponent(query))
                        .then(res => {
                            if (!res.ok) throw new Error(`HTTP error! status: ${res.status}`);
                            return res.json();
                        })
                        .then(data => {
                            searchBoxFeildItem.innerHTML = '';
                            console.log(155, data)

                            if (data.users.length === 0 && data.categories.length === 0 && data.items.length === 0) {
    searchBoxFeildItem.innerHTML = '<div class="result-item">No Result</div>';
    return;
}

                        data.users.forEach(user => {
                            const div = document.createElement('div');
                            div.className = 'result-item';
                            div.textContent = `[User] ${user.Username}`;
                            searchBoxFeildItem.appendChild(div);
                        });

                        // عرض الأصناف
                        data.categories.forEach(cat => {
                            const div = document.createElement('div');
                            div.className = 'result-item';
                            div.textContent = `[Category] ${cat.Name}`;
                            searchBoxFeildItem.appendChild(div);
                        });

                        // عرض العناصر
                        data.items.forEach(item => {
                            const div = document.createElement('div');
                            div.className = 'result-item';
                            div.textContent = `[Item] ${item.Item_name}`;
                            searchBoxFeildItem.appendChild(div);
                        });

                        })
                        .catch(error => {
                            console.error("Search error:", error);
                            searchBoxFeildItem.innerHTML = '<div class="result-item">حدث خطأ</div>';
                        });
                    }, 300);
                } else {
                    searchBoxFeildItem.innerHTML = '';
                }

                console.log(query)
            })

    }

}
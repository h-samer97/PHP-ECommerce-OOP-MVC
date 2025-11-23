class AppUI {
    constructor() {
        // عناصر الإدخال
        this.userInput = document.querySelector('.username');
        this.passwordInput = document.querySelector('.password');
        this.ulMenuUserParent = document.querySelector('.information-user');

        // الحقول المطلوبة
        this.allInputFields = Array.from(document.querySelectorAll('input'));
        this.requiredFields = this.allInputFields.filter(input => input.required);

        // عناصر القائمة المنسدلة
        this.navDropDownMenu = document.querySelector('.ndd-list');
        this.navDropDownMenuName = document.querySelector('.nav-drop-down > span');

        // أيقونة إظهار كلمة المرور
        this.eyePasswordField = document.querySelector("#eye");

        // عناصر الداشبورد
        this.headerInfo = Array.from(document.querySelectorAll(".latest-info"));
        this.icons = document.querySelectorAll(".lt-pm");

        // عناصر الحذف
        this.deleteButtons = document.querySelectorAll('.delete-control');
    }

    init() {
        this.toggleNavMenu();
        this.togglePasswordVisibility();
        this.dashboardToggle();
        this.addRequiredAsterisk();
        this.togglePlaceholder(this.userInput);
        this.togglePlaceholder(this.passwordInput);
        this.confirmDelete();
        this.showLoaderOnLoad();
        this.renderUsersDatesChart();
    }

    toggleNavMenu() {
        if (this.navDropDownMenuName) {
            this.navDropDownMenuName.addEventListener('click', () => {
                this.navDropDownMenu.classList.toggle('show');
            });
        }
    }

    togglePasswordVisibility() {
        if (this.eyePasswordField) {
            this.eyePasswordField.addEventListener("click", () => {
                if (this.passwordInput.getAttribute("type") === "password") {
                    this.passwordInput.setAttribute("type", "text");
                } else {
                    this.passwordInput.setAttribute("type", "password");
                }
            });
        }
    }

    dashboardToggle() {
        this.headerInfo.forEach((div, n) => {
            div.onclick = () => {
                div.nextElementSibling.classList.toggle("animation");

                if (this.icons[n].classList.contains("fa-plus")) {
                    this.icons[n].classList.add("fa-minus");
                    this.icons[n].classList.remove("fa-plus");
                } else if (this.icons[n].classList.contains("fa-minus")) {
                    this.icons[n].classList.add("fa-plus");
                    this.icons[n].classList.remove("fa-minus");
                }
            };
        });
    }

    addRequiredAsterisk() {
        this.requiredFields.forEach(input => {
            const astrisk = document.createElement('span');
            astrisk.textContent = "*";
            astrisk.classList.add("astrisk");
            input.insertAdjacentElement('afterend', astrisk);
        });
    }

    togglePlaceholder(input) {
        if (!input) return;
        const placeholderText = input.getAttribute('placeholder');
        input.addEventListener('focus', () => input.setAttribute("placeholder", ''));
        input.addEventListener('blur', () => input.setAttribute("placeholder", placeholderText));
    }

    confirmDelete() {
        this.deleteButtons.forEach(button => {
            button.addEventListener('click', (event) => {
                let status = confirm("Are You Sure?");
                if (!status) {
                    event.preventDefault();
                }
            });
        });
    }

    

    showLoaderOnLoad() {
        window.addEventListener('DOMContentLoaded', () => {
            const loaderIcon = document.querySelector('.load-icon');
            if (loaderIcon) {
                loaderIcon.classList.add('load-icon-show');
            }
        });
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

    dashboardCanvasCharts() {
        var canvas = document.getElementById('charts').getContext('2d');
            new Chart(canvas, {
            type: 'pie', // نوع الرسم: bar, line, pie, ...
            data: {
            labels: ['يناير', 'فبراير', 'مارس', 'أبريل', 'مايو'],
            datasets: [{
                label: 'users',
                data: [12, 19, 3, 5, 2],
                backgroundColor: [
                'rgba(255, 99, 132, 0.5)',
                'rgba(54, 162, 235, 0.5)',
                'rgba(255, 206, 86, 0.5)',
                'rgba(75, 192, 192, 0.5)',
                'rgba(153, 102, 255, 0.5)'
                ],
                borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)'
                ],
                borderWidth: 1
            }]
            },
            options: {
            responsive: true,
            scales: {
                y: {
                beginAtZero: true
                }
            }
            }
        });
    }

    static showLoader() {
        document.getElementById("loader").style.display = "block";
    }
}

window.onload = () => {
    const app = new AppUI();
    app.init();
};

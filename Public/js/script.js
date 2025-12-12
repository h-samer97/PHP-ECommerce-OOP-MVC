import API from "./chartsAPI.js";



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

        this.burgerSideBar = document.querySelector('.side-br') ?? null;

        this.aside = document.querySelector('aside');

        this.api = new API();
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
        // this.toggleSideBarStatus();
        // this.api.renderCatsAPI();
        this.api.renderUsersDatesChart();
        this.api.searchBox();
        this.api.monthlyRegistrationCount();
        // this.api.renderUsersDatesChart;
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

    toggleSideBarStatus() {
        this.burgerSideBar.addEventListener('click', () => {

            this.aside.classList.toggle('hide');

        });
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

    

   
    static showLoader() {
        document.getElementById("loader").style.display = "block";
    }
}

window.onload = () => {
    const app = new AppUI();
    app.init();
};

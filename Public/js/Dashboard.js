
export default class Dashboard {

     async getInformationToDashboard() {

        try {

            let response = await fetch('api/getInformationToDashboard');

            if(!response.ok) {
                throw new Error(`Data NOT Found! - HTTP error! ==> Status: ${response.status}`);
            }

            let user = await response.json();

           document.getElementById('username').textContent = user.UserName || 'Guest';
            document.getElementById('fullname').textContent = user.FullName || 'No name';
            document.getElementById('email').textContent = user.Email || 'Unknown';

            if(!user.avatar) {
                document.getElementById('avatar').src = '../ico/user.ico';
            }

            document.getElementById('itemsCount').textContent = user.All_Items ?? 0;

            document.getElementById('dateReg').textContent = user.Date_Reg ?? '';

        } catch(error) {
            console.error(`Uncaught error: ${error}\nField Fetch API ==> [--> getInformationToDashboard <--]`);
        }

     }

     async fetchNotifications(){

        const notif = await fetch('api/getNotifs');

        if(!notif.ok) throw new Error('Error HTTP - field fetch or Update Notifications!');

        const data = await notif.json();

        document.querySelectorAll('.notif-show').forEach(n => n.remove());

        const btnNotif = document.querySelector('#notifications');
        const btnNotifDiv = document.createElement('div');
            //   btnNotifDiv.classList.add('notif-show');
        
        data.forEach(d => {
            const btnNotifDivitem = document.createElement('span');
            const btnNotifDivText = document.createTextNode(d.message);
            btnNotifDivitem.classList.add('n-item');
            btnNotifDivitem.appendChild(btnNotifDivText);
            btnNotifDiv.appendChild(btnNotifDivitem);
        });
        
        btnNotif.appendChild(btnNotifDiv);

        btnNotif.addEventListener('click', () => {
            btnNotifDiv.classList.toggle('notif-show');
        });

        window.addEventListener('scroll', () => {
            btnNotifDiv.classList.remove('notif-show');
        });

     }

}
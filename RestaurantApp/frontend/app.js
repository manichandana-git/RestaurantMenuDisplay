const { createApp } = Vue;

createApp({
    data() {
        return {
            menu: [] // Stores menu items
        };
    },
    methods: {
        fetchMenu() {
            fetch('http://localhost:8000/get_menu.php')
            .then(response => response.json())
            .then(data => {
                this.menu = data;
            })
            .catch(error => {
                console.error("Error fetching menu:", error);
            });
        }
    },
    mounted() {
        this.fetchMenu();  // Fetches menu on page load
    }
}).mount('#app');

const filtersBtn = document.querySelector('.filters-mobile-btn');
        const filters = document.querySelector('.filters');
        const filtersClose = document.querySelector('.filters-close');
        const overlay = document.querySelector('.overlay');

        filtersBtn.addEventListener('click', () => {
            filters.classList.add('active');
            overlay.classList.add('active');
        });

        filtersClose.addEventListener('click', () => {
            filters.classList.remove('active');
            overlay.classList.remove('active');
        });

        overlay.addEventListener('click', () => {
            filters.classList.remove('active');
            overlay.classList.remove('active');
        });
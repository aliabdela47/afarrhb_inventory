import './bootstrap';

// Language switcher
window.switchLanguage = function(lang) {
    document.cookie = `locale=${lang};path=/;max-age=31536000`;
    window.location.reload();
};

// Print functionality
window.printReport = function() {
    window.print();
};

// Ethiopian Calendar Helper (basic conversion)
window.EthiopianCalendar = {
    // Ethiopian months
    months: [
        'መስከረም', 'ጥቅምት', 'ህዳር', 'ታህሳስ', 'ጥር', 'የካቲት',
        'መጋቢት', 'ሚያዝያ', 'ግንቦት', 'ሰኔ', 'ሐምሌ', 'ነሐሴ', 'ጳጉሜ'
    ],
    
    monthsEn: [
        'Meskerem', 'Tikimt', 'Hidar', 'Tahsas', 'Tir', 'Yekatit',
        'Megabit', 'Miazia', 'Ginbot', 'Sene', 'Hamle', 'Nehasse', 'Pagume'
    ],
    
    // Simple conversion (approximate - real conversion needs more complex calculation)
    gregorianToEthiopian: function(date) {
        const gregYear = date.getFullYear();
        const gregMonth = date.getMonth() + 1;
        const gregDay = date.getDate();
        
        // Approximate Ethiopian year (Gregorian - 7/8 years)
        let ethYear = gregYear - 7;
        if (gregMonth <= 9 || (gregMonth === 9 && gregDay < 11)) {
            ethYear = gregYear - 8;
        }
        
        return {
            year: ethYear,
            month: ((gregMonth + 4) % 13) || 1,
            day: gregDay
        };
    },
    
    formatEthiopian: function(date, lang = 'am') {
        const eth = this.gregorianToEthiopian(date);
        const months = lang === 'am' ? this.months : this.monthsEn;
        return `${months[eth.month - 1]} ${eth.day}, ${eth.year}`;
    }
};

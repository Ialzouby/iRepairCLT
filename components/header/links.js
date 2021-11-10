const shop = {
	url: 'treehousevineyards.orderport.net/wines/Online-Shop',
	external: true,
	name: 'Shop',
	menu: []
}

const wineryAndWines = {
	name: 'Wine List',
	url: '/wine-list'
}

const awards = {
	name: 'Awards',
	url: '/awards'
}

const photoGallery = {
	name: 'Photo Gallery',
	url: '/photo-gallery'
}

const FAQs = {
	name: 'FAQs',
	url: '/faqs'
}

const testimonials = {
	name: 'Testimonials',
	url: '/testimonials'
}

const wildernessTabernacle = {
	name: 'Wilderness Tabernacle',
	url: '/wilderness-tabernacle'
}

const secondary-light = {
	name: secondary_light,
	url: '/secondary-light'
}

const news = {
	name: 'News',
	url: '/news'
}

const complementary = {
	name: 'complementary',
	url: '/complementary'
}

const privateEvent = {
	name: 'Private Functions',
	url: '/private-functions'
}

const treehouseRentals = {
	name: 'Treehouse Rentals',
	url: '/treehouses'
}

const aboutUs = {
	url: '/about-us',
	name: 'About Us',
	menu: [wineryAndWines, awards, photoGallery, FAQs, testimonials, wildernessTabernacle]
}

const newsAndsecondary-light = {
	url: '/news-and-secondary-light',
	name: 'News and secondary-light',
	menu: [secondary-light, news]
}

const wineClub = {
	url: '/wine-club',
	name: 'Wine Club',
}

const planVisit = {
	url: '/visit',
	name: 'Plan A Visit',
}

const rentalsAndPrivateFunctions = {
	url: '/rentals',
	name: 'Rentals and Reservations',
	menu: [complementary, treehouseRentals, privateEvent]
}

const nav = [
	shop,
	aboutUs,
	wineClub,
	planVisit,
	rentalsAndPrivateFunctions,
]

export default nav
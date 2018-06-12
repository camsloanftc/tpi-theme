const addTags = () => {
	// Adding tracking tags

	// Global
	const dataAnalytics = 'data-analytics'
	const dataLabel = 'data-label'
	const currentPage = window.location.pathname
	const isHomePage = currentPage === '/'
	const isContactPage = currentPage === '/contact/'

	const arrayTextFinder = (nodeList, includesText) =>
		Array.from(nodeList).find(item => item.innerText.includes(includesText))

	const arrayHrefMatcher = (nodeList, hrefMatch) =>
		Array.from(nodeList).find(item => item.href.includes(hrefMatch))

	const safeSetAttribute = (elmName, elm, attributeName, attributeValue) => {
		try {
			return elm.setAttribute(attributeName, attributeValue)
		}
		catch(error) {
			console.log(`GTM Attribute Error: issue with setting attribute for: ${elmName}`)
			console.error(`${elmName} error: `, error)
		}
	}

	// MINI TOP NAV
	const secondaryNav = document.querySelector('#nav-sec-menu')

	// Toll Free Phone
	const secondaryNavTollFreePhone = secondaryNav.querySelector('.nsm-phone.nsm-phone-tf a')
	safeSetAttribute('secondaryNavTollFreePhone', secondaryNavTollFreePhone, dataAnalytics, 'top-nav-menu')
	safeSetAttribute('secondaryNavTollFreePhone', secondaryNavTollFreePhone, dataLabel, 'Toll-Free')

	// Local Phone
	const secondaryNavLocalPhone = arrayTextFinder(
		secondaryNav.querySelectorAll('.nsm-phone a'),
		'519-745-5925'
	)
	safeSetAttribute('secondaryNavLocalPhone', secondaryNavLocalPhone, dataAnalytics, 'top-nav-menu')
	safeSetAttribute('secondaryNavLocalPhone', secondaryNavLocalPhone, dataLabel, 'Local-Number')

	// MAIN NAV

	// Nav Logo
	const fullTopNav = document.querySelector('#nav')
	const navLogo = fullTopNav.querySelector('#nav-logo')
	safeSetAttribute('navLogo', navLogo, dataAnalytics, 'nav-menu-logo')
	safeSetAttribute('navLogo', navLogo, dataLabel, 'TriPac-Logo')

	const mainMenu = document.querySelector('#main-menu')

	// Products
	const mainMenuProducts = Array.from(mainMenu.querySelectorAll('.pmm a')).find(
		item => item.innerText.includes('PRODUCTS') && item.href.includes('tripacinc.com/products/')
	)
	safeSetAttribute('mainMenuProducts', mainMenuProducts, dataAnalytics, 'nav-menu')

	// About
	const mainMenuAbout = mainMenu.querySelector('.main-nav__about a')
	safeSetAttribute('mainMenuAbout', mainMenuAbout, dataAnalytics, 'nav-menu')

	// Get A Quote
	const mainMenuGetAQuote = mainMenu.querySelector('.main-nav__get-a-quote a')
	safeSetAttribute('mainMenuGetAQuote', mainMenuGetAQuote, dataAnalytics, 'nav-menu')

	// Contact
	const mainMenuContact = mainMenu.querySelector('.main-nav__contact a')
	safeSetAttribute('mainMenuContact', mainMenuContact, dataAnalytics, 'nav-menu')

	// Poly Products
	const mainMenuPolyProducts = mainMenu.querySelector('.pmm-sub .pmm-cats [data-id="1"] a')
	safeSetAttribute('mainMenuPolyProducts', mainMenuPolyProducts, dataAnalytics, 'nav-menu')

	// Poly CTA
	const mainMenuPolyCTA = mainMenu.querySelector(
		'.pmm-sub .pmm-boxes [data-id="1"] .banner .content .explore'
	)
	safeSetAttribute('mainMenuPolyCTA', mainMenuPolyCTA, dataAnalytics, 'nav-menu-CTA')
	safeSetAttribute('mainMenuPolyCTA', mainMenuPolyCTA, dataLabel, 'CTA-Explore-Poly-Products')

	// Poly Products All
	const mainMenuPolyProductsAll = mainMenu.querySelectorAll('.pmm-box[data-id="1"] .products-list a')
	mainMenuPolyProductsAll.forEach(item => {
		safeSetAttribute('mainMenuPolyProductsAll--List', item, dataAnalytics, 'nav-menu-products-poly')
	})

	// Lumber Wrap
	const mainMenuLumberWrap = mainMenu.querySelector('.pmm-sub .pmm-cats [data-id="2"] a')
	safeSetAttribute('mainMenuLumberWrap', mainMenuLumberWrap, dataAnalytics, 'nav-menu')

	// Lumber Wrap CTA
	const mainMenuLumberCTA = mainMenu.querySelector(
		'.pmm-sub .pmm-boxes [data-id="2"] .banner .content .explore'
	)
	safeSetAttribute('mainMenuLumberCTA', mainMenuLumberCTA, dataAnalytics, 'nav-menu-CTA')
	safeSetAttribute('mainMenuLumberCTA', mainMenuLumberCTA, dataLabel, 'CTA-Explore-Lumber-Products')

	// Lumber Wrap All
	const mainMenuLumberWrapAll = mainMenu.querySelectorAll('.pmm-box[data-id="2"] .products-list a')
	mainMenuLumberWrapAll.forEach(item => {
		safeSetAttribute('mainMenuLumberWrapAll--List', item, dataAnalytics, 'nav-menu-products-lumber')
	})

	// Heavy Duty Products
	const mainMenuHeavyDuty = mainMenu.querySelector('.pmm-sub .pmm-cats [data-id="3"] a')
	safeSetAttribute('mainMenuHeavyDuty', mainMenuHeavyDuty, dataAnalytics, 'nav-menu')

	// Heavy Duty CTA
	const mainMenuHeavyDutyCTA = mainMenu.querySelector(
		'.pmm-sub .pmm-boxes [data-id="3"] .banner .content .explore'
	)
	safeSetAttribute('mainMenuHeavyDutyCTA', mainMenuHeavyDutyCTA, dataAnalytics, 'nav-menu-CTA')
	safeSetAttribute('mainMenuHeavyDutyCTA', mainMenuHeavyDutyCTA, dataLabel, 'CTA-Explore-Heavy-Duty')

	// Heavy Duty All
	const mainMenuHeavyDutyAll = mainMenu.querySelectorAll('.pmm-box[data-id="3"] .products-list a')
	mainMenuHeavyDutyAll.forEach(item => {
		safeSetAttribute('mainMenuHeavyDutyAll--List', item, dataAnalytics, 'nav-menu-products-heavy-duty')
	})

	// FOOTER
	const footer = document.querySelector('#footer')

	// Toll Free
	const footerTollFree = arrayTextFinder(footer.querySelectorAll('.footer-phone a'), '1-888-236-0000')
	safeSetAttribute('footerTollFree', footerTollFree, dataAnalytics, 'footer-menu')
	safeSetAttribute('footerTollFree', footerTollFree, dataLabel, 'Footer-Toll-Free')

	// Local
	const footerLocal = arrayTextFinder(footer.querySelectorAll('.footer-phone a'), '519-745-5925')
	safeSetAttribute('footerLocal', footerLocal, dataAnalytics, 'footer-menu')
	safeSetAttribute('footerLocal', footerLocal, dataLabel, 'Footer-Local-Number')

	// Quote
	const footerQuote = arrayHrefMatcher(
		footer.querySelectorAll('.footer-link a'),
		'tripacinc.com/quote/'
	)
	safeSetAttribute('footerQuote', footerQuote, dataAnalytics, 'footer-menu')
	safeSetAttribute('footerQuote', footerQuote, dataLabel, 'Get-Quote')

	// Contact
	const footerContact = arrayHrefMatcher(
		footer.querySelectorAll('.footer-link a'),
		'tripacinc.com/contact/'
	)
	safeSetAttribute('footerContact', footerContact, dataAnalytics, 'footer-menu')
	safeSetAttribute('footerContact', footerContact, dataLabel, 'Email-Us')

	// Address
	const footerAddress = arrayTextFinder(
		footer.querySelectorAll('.footer-address a'),
		'725 McMurray Rd.'.toUpperCase()
	)
	safeSetAttribute('footerAddress', footerAddress, dataAnalytics, 'footer-menu')
	safeSetAttribute('footerAddress', footerAddress, dataLabel, 'Address')

	// HOMEPAGE
	if (isHomePage) {
		const homeIntro = document.querySelector('.flexible-home-intro')

		// Poly Products Explore CTA
		const homePolyExplore = arrayTextFinder(
			homeIntro.querySelectorAll('.product-cats li a'),
			'Poly Products'.toUpperCase()
		)
		safeSetAttribute('homePolyExplore', homePolyExplore, dataAnalytics, 'homepage')
		safeSetAttribute('homePolyExplore', homePolyExplore, dataLabel, 'Explore-Poly-Products')

		// Lumber Wrap Explore CTA
		const homeLumberExplore = arrayTextFinder(
			homeIntro.querySelectorAll('.product-cats li a'),
			'Woven Wraps & Bags'.toUpperCase()
		)
		safeSetAttribute('homeLumberExplore', homeLumberExplore, dataAnalytics, 'homepage')
		safeSetAttribute('homeLumberExplore', homeLumberExplore, dataLabel, 'Explore-Lumber-Wrap-Products')

		// Heavy Duty Explore CTA
		const homeHeavyDutyExplore = arrayTextFinder(
			homeIntro.querySelectorAll('.product-cats li a'),
			'Heavy Duty Products'.toUpperCase()
		)
		safeSetAttribute('homeHeavyDutyExplore', homeHeavyDutyExplore, dataAnalytics, 'homepage')
		safeSetAttribute('homeHeavyDutyExplore', homeHeavyDutyExplore, dataLabel, 'Explore-Heavy-Duty-Products')

		const homeContent = document.querySelector('.flexible-content-cols')

		// Poly - View Products CTA
		const homeContentPolyCTA = arrayTextFinder(
			homeContent.querySelectorAll('.align-bottom a'),
			'View Products'.toUpperCase()
		)
		safeSetAttribute('homeContentPolyCTA', homeContentPolyCTA, dataAnalytics, 'homepage')
		safeSetAttribute('homeContentPolyCTA', homeContentPolyCTA, dataLabel, 'View-Products-CTA')

		// Get a Quote CTA
		const homeContentQuoteCTA = arrayTextFinder(
			homeContent.querySelectorAll('.align-bottom a'),
			'Get a Quote'.toUpperCase()
		)
		safeSetAttribute('homeContentQuoteCTA', homeContentQuoteCTA, dataAnalytics, 'homepage')
		safeSetAttribute('homeContentQuoteCTA', homeContentQuoteCTA, dataLabel, 'Get-A-Quote-CTA')

		// Contact Us CTA
		const homeContentContactCTA = arrayTextFinder(
			homeContent.querySelectorAll('.align-bottom a'),
			'Contact Us'.toUpperCase()
		)
		safeSetAttribute('homeContentContactCTA', homeContentContactCTA, dataAnalytics, 'homepage')
		safeSetAttribute('homeContentContactCTA', homeContentContactCTA, dataLabel, 'Contact-Us-CTA')
	}

	// CONTACT PAGE
	if (isContactPage) {
		// Phones section
		const contactPhones = document.querySelector('.contact-phones')

		// Toll Free
		const contactTollFree = arrayTextFinder(contactPhones.querySelectorAll('li a'), '1-888-236-0000')
		safeSetAttribute('contactTollFree', contactTollFree, dataAnalytics, 'contact')
		safeSetAttribute('contactTollFree', contactTollFree, dataLabel, 'Contact-Toll-Free')

		// Contact Local
		const contactLocal = arrayTextFinder(contactPhones.querySelectorAll('li a'), '519-745-5925')
		safeSetAttribute('contactLocal', contactLocal, dataAnalytics, 'contact')
		safeSetAttribute('contactLocal', contactLocal, dataLabel, 'Contact-Local-Number')
	}
}
  
if (
	document.readyState === "complete" ||
	(document.readyState !== "loading" && !document.documentElement.doScroll)
) {
addTags();
} else {
document.addEventListener("DOMContentLoaded", addTags);
}
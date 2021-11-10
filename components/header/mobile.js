import cx from 'classnames'
import {useRef, useState, useEffect} from 'react'
 import Link from 'components/link'
import Image from 'components/image'
import Banner from 'components/header/banner'

import global from 'styles/global.module.scss'
import layout from 'styles/layout.module.scss'
import local from 'styles/components/header/mobile.module.scss'

import ContactInfo from 'components/contactInfo'
import Carrot from 'components/carrot'
import HoursOfOperation from 'components/hoursOfOperation'
import Calendar from 'components/header/calendar'

const FactoryNavLink = (props) => {
	const {url="", name, key, external} = props
	return (
		<Link external={external} key={key} href={url}>
			<div className={cx(local.nav_link, global.text_black)}>
				{name}
			</div>
		</Link>
	)
}

export default (props) => {
	const {
		nav=[]
	} = props
	const [displayNav, setDisplayNav] = useState(false)
	const [navHeight, setNavHeight] = useState(60)
	const [subMenu, setSubMenu] = useState(false)
	const navBarRef = useRef(null)
	const navMenuRef = useRef(null)
	const hamburgerMenu = useRef(null)
	const navSubMenuRef = {}

	useEffect(()=> navBarRef.current && setNavHeight(navBarRef.current.offsetHeight - 2))
	useEffect(()=> {
		navMenuRef.current && displayNav && navMenuRef.current.classList.add(local.visible)
		document.querySelector("html").style.overflow = displayNav ? "hidden" : "auto"
	}, [displayNav])

	useEffect(()=> {
		Object.entries(navSubMenuRef).map((x)=> {
			const navHeight = `${[...x[1].children].map((x)=> x.offsetHeight).reduce((a, b)=> a + b) + 20}px`
			x[1].style.height = Number(x[0]) === subMenu ? navHeight : "0px"
		}) 
	}, [subMenu])

	const closeNav = () => {
		navMenuRef.current && navMenuRef.current.classList.remove(local.visible)
		setSubMenu(false)
		setTimeout(()=> {
			clearTimeout()
			setDisplayNav(false)
		}, 250)
	}

	const toggleNav = () => {
		if (hamburgerMenu.current) {
			const hm = hamburgerMenu.current.classList
			displayNav ? hm.remove(local.animate_bar) : hm.add(local.animate_bar)
		}
		displayNav ? closeNav() : setDisplayNav(true)
	}

  return (
		<div ref={navBarRef} className={cx(local.mobile_nav_bar, layout.w100_percent, layout.f_row, layout.f_wrap, layout.justify_between, layout.align_center)}>
			<div className={cx(local.icon_wrapper)}>
				<div 
					className={cx(local.hamburger)}
					onClick={()=> toggleNav()}
					ref={hamburgerMenu}
				>
					<span className={local.bar}></span>
					<span className={local.bar}></span>
					<span className={local.bar}></span>
				</div>
			</div>
			<Link href='/'>
				<Image 
					src="/images/logo.png"
					alt="logo"
					height="65"
					className={local.logo}
				/>
			</Link>
			<div className={cx(local.icon_wrapper)}>
				<Calendar iconSize={40} />
			</div>
			{displayNav && (
				<div 
					className={cx(local.mobile_nav, layout.f_col, layout.justify_between)}
					style={{top: `${navHeight}px`}}
					ref={navMenuRef}
				>
					<div>
						{nav.map((x, i)=> {
							return (
								<div className={cx(local.menu_item)}>
									{x.menu && x.menu.length > 0 ? (
										<>
											<div 
												className={cx(layout.f_row, layout.justify_between, layout.align_center)}
												onClick={()=> setSubMenu(subMenu === i ? false : i)}
											>
												<FactoryNavLink
													name={x.name}
													key={i}
													external={x.external}
												/>
												<div className={cx(local.carrot, {[local.rotate]: i === subMenu})}>
													<Carrot />
												</div>
											</div>
											<div 
												className={cx(local.sub_nav)}
												ref={(e)=> navSubMenuRef[i] = e}
											>
												<FactoryNavLink	
													external={x.external} 
													url={x.url} 
													name={x.name} 
													key={i} 
												/>
												{x.menu.map((y, i)=> <FactoryNavLink external={y.external} url={x.url + y.url} name={y.name} key={i} /> )}
											</div>
										</>
									) : <FactoryNavLink	
												external={x.external}
												url={x.url} 
												name={x.name} 
												key={i} 
											/>
									}
								</div>
							)
						})}
					</div>
					<ContactInfo />
					<HoursOfOperation small={true} position="left" />
					<Banner type="mobile" />
				</div>
			)}
		</div>
	)
}

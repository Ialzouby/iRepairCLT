import cx from 'classnames'
import { useEffect, useRef, useState } from 'react'
 import Link from 'components/link'
import Image from 'components/image'
import global from 'styles/global.module.scss'
import layout from 'styles/layout.module.scss'
import local from 'styles/components/header/desktop.module.scss'
import Banner from 'components/header/banner'
import Calendar from 'components/header/calendar'
import ContactInfo from 'components/contactInfo'
import HoursOfOperation from 'components/hoursOfOperation'


export default (props) => {
	const {
		nav = []
	} = props
	const [displayContactModal, setDisplayContactModal] = useState(false)
	const contactModal = useRef(null)
	useEffect(() => displayContactModal && contactModal.current && contactModal.current.classList.add(local.visible), [displayContactModal])

	const closeContactModal = (e) => {
		e.stopPropagation()
		contactModal.current && contactModal.current.classList.remove(local.visible)
		setTimeout(() => {
			clearTimeout()
			setDisplayContactModal(false)
		}, 250)
	}

	const factoryNavLink = (x, i, pre = '') => {
		return (
			<Link external={x.external} key={i} href={pre + x.url}>
				<div className={cx(local.nav_link, global.text_black)}>
					{x.name}
				</div>
			</Link>
		)
	}
	return (
		<>
			<Banner />
			<div className={cx(local.desktop_nav, layout.w100_percent, layout.f_row, layout.f_wrap, layout.justify_between, layout.align_center)}>
				<div className={cx(local.side_row)}>
					<Link href='/'>
						<Image
							src="/images/logo.png"
							alt="logo"
							height="60"
							className={local.logo}
						/>
					</Link>
				</div>
				<div className={cx(layout.f_row, layout.f_wrap, layout.justify_center, local.nav_row)}>
					{nav.map((x, i) => {
						return (
							<div
								className={local.menu_item}
								key={i}
							>
								{factoryNavLink(x, i)}
								{x.menu && x.menu.length > 0 && (
									<div className={cx(local.sub_nav_outer)}>
										<div className={cx(local.sub_nav_inner, layout.f_col, layout.f_wrap, layout.align_center)}>
											{x.menu.map((y, i) => factoryNavLink(y, i, x.url))}
										</div>
									</div>
								)}
							</div>
						)
					})}
				</div>
				<div className={cx(local.side_row, layout.f_row)}>
					<div
						className={local.icon}
						onClick={() => setDisplayContactModal(true)}
					>
						<Image
							src="/images/icons/contact-thin.svg"
							alt="contact icon"
							height="35"
							width="35"
						/>
						{displayContactModal && (
							<>
								<div
									className={local.contact_backdrop}
									onClick={(e) => closeContactModal(e)}
								/>
								<div
									className={local.contact_modal}
									ref={contactModal}
								>
									<ContactInfo />
									<HoursOfOperation small={true} />
								</div>
							</>
						)}
					</div>
					<div className={local.icon}>
						<Calendar />
					</div>
				</div>
			</div>
		</>
	)
}

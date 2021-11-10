import cx from 'classnames'
import Link from 'components/link'
import Image from 'components/image'

import layout from 'styles/layout.module.scss'
import local from 'styles/components/contact-info.module.scss'

const FactoryContactLink = (props) => {
	const {
		iconSrc,
		iconAlt,
		iconSize=35,
		link,
		text
	} = props

	return (
		<Link href={link}>
			<div className={cx(local.contact_link, layout.f_row, layout.align_center, layout.justify_stretch)}>
				<div className={local.icon_bubble}>
					<Image 
						src={iconSrc}
						alt={iconAlt}
						height={iconSize}
						width={iconSize}
						className={local.contact_icon}
					/>
				</div>
				<p className={cx(local.contact_text)}>{text}</p>
			</div>
		</Link>
	)
}

export default (props) => {
	const {
		flex="col"
	} = props
	return (
		<div className={cx(local.contact_info, layout.[`f_${flex}`], layout.f_wrap, layout.align_start)}>
			<FactoryContactLink
				iconSrc="/images/icons/email.svg"
				iconAlt="contact icon"
				link="mailto:info@treehousevineyards.com"
				text="info@treehousevineyards.com"
			/>
			<FactoryContactLink
				iconSrc="/images/icons/phone-thin-alt.svg"
				iconAlt="contact icon"
				link="tel:7042834208"
				text="704.283.4208"
			/>
			<FactoryContactLink
				iconSrc="/images/icons/location-thin.svg"
				iconAlt="contact icon"
				link="https://www.google.com/maps/place/Treehouse+Vineyards/@34.9686833,-80.5532193,17z/data=!4m5!3m4!1s0x8854312e45a00e0f:0x15ab59e51ee43d1c!8m2!3d34.9686833!4d-80.551030634208"
				text="301 Bay St, Monroe, NC 28112"
			/>
		</div>
	)
}
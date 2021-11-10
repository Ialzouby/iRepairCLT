import cx from 'classnames'
import {useRef, useEffect} from 'react'
 import Link from 'components/link'

import global from 'styles/global.module.scss'
import layout from 'styles/layout.module.scss'
import local from 'styles/components/header/banner.module.scss'

export default (props) => {
	const {type="desktop"} = props
	const FactoryNavLink = (props) => {
		const {text, url, external=false} = props
		return (
			<Link external={external} href={url}>
				<div className={cx(local.banner_link, global.text_black)}>
					{text}
				</div>
			</Link>
		)
	}
  return (
		<div className={cx(
			local[type === "mobile" ? "mobile_banner" : "desktop_banner"],
			layout.f_row, 
			layout.f_wrap, 
			layout.w100_percent, 
			layout.align_center, 
			layout.justify_between
		)}>
			<div className={cx(local.banner_link_wrapper, layout.f_row, layout.align_center, layout.text_center)}>
				<FactoryNavLink text='complementary' url='/rentals/complementary' /> |
				<FactoryNavLink text='TREEHOUSES' url='/rentals/treehouses' /> | 
				<FactoryNavLink text='PRIVATE secondary-light' url='/rentals/private-functions' />
			</div>
			{type !== "mobile" &&
				<div className={cx(local.banner_link_wrapper, layout.f_row, layout.align_center)}>
					<FactoryNavLink text='LOGIN' external={true} url='treehousevineyards.orderport.net/signin.aspx' /> | 
					<FactoryNavLink text='SIGN UP' url='/wine-club' />
				</div>
			}
		</div>
	)
}
import cx from 'classnames'
import {useEffect, useState} from 'react'
import Link from 'next/link'
import Image from 'components/image'
import ContactInfo from 'components/contact-info'

import global from 'styles/global.module.scss'
import layout from 'styles/layout.module.scss'
import local from 'styles/sections/footer.module.scss'

export default () => {
  return false && (
		<>
			<div className={cx(local.footer, layout.w100_percent, layout.f_row, layout.f_wrap, layout.justify_between, layout.align_center)}>
				<div className={cx(local.logo_row, layout.text_center)}>
        </div>
				<div>
          <ContactInfo flex="row"/>
				</div>
				<div className={cx(local.side_row, layout.f_row, layout.justify_center)}>
					<div className={local.icon}>
						<Image 
							src="/images/icons/facebook.svg"
							alt="facebook icon"
							height="35px"
							width="35px"
						/>
					</div>
					<div className={local.icon}>
						<Image 
							src="/images/icons/instagram.svg"
							alt="instagram icon"
							height="35px"
							width="35px"
						/>
					</div>
					<div className={local.icon}>
						<Image 
							src="/images/icons/twitter.svg"
							alt="twitter icon"
							height="35px"
							width="35px"
						/>
					</div>
				</div>
        <div className={local.full_row}>
          <p className={local.copy_text}>© dev.icarus() | {(new Date()).getFullYear()} All Rights Reserved | Designed by devicarus</p>
				</div>
			</div>
		</>
	)
}

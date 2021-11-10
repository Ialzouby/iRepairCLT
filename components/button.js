import {useState, useEffect, useRef} from 'react'
import cx from 'classnames'
import Link from 'components/link'
import local from 'styles/components/button.module.scss'

export default (props) => {
	const {
		href=false,
		link=false,
		basic=false,
		light=false,
		type=false,
		arrow=false,
		external=false,
		onClick=()=>null,
		children
	} = props

  return href ? (
    <Link href={`${external ? '/api/external/' : ''}${href}`}>
				<div className={cx({
					[local.btn]: !link,
					[local.link]: link,
					[local.basic]: basic, 
					[local.light]: light,
					[local[type]]: type
				})}>
					{children}
					{arrow && <span className={local.arrow}>&rarr;</span>}
				</div> 
    </Link>
  ) : (
		<button 
			onClick={onClick} 
			className={cx({
			[local.btn]: !link,
			[local.link]: link,
			[local.basic]: basic, 
			[local.light]: light,
			[local[type]]: type
		})}>
			{children}
			{arrow && <span className={local.arrow}>&rarr;</span>}
		</button> 
	)
}

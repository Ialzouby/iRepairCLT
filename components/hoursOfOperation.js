import cx from 'classnames'
import {useEffect} from 'react'
 import Link from 'components/link'
import Image from 'components/image'


import global from 'styles/global.module.scss'
import layout from 'styles/layout.module.scss'
import local from 'styles/components/hoursOfOperation.module.scss'


export default (props) => {	
	const { position="center", small=false } = props
  return (
		<div className={cx(layout.container, local.hours_of_operation, layout[`text_${position}`])}>
			<h5>Current Hours</h5>
			<ul 
				className={cx(local.hours, {[local.small]: small})}
				ref={(e)=> e && e.children[(new Date()).getDay()].classList.add(local.today)}
			>
				<li>Sun: 12:00pm - 6:00pm</li>
				<li>Mon: 12:00pm - 6:00pm</li>
				<li>Tues: 12:00pm - 6:00pm</li>
				<li>Wed: 12:00pm - 6:00pm</li>
				<li>Thurs: 12:00pm - 6:00pm</li> 
				<li>Fri: 12:00pm - 10:00pm</li>
				<li>Sat: 12:00pm - 10:00pm</li>
			</ul>
		</div>
	)
}

import cx from 'classnames'
import {useState, useEffect} from 'react'
import Image from 'components/image'

import global from 'styles/global.module.scss'
import layout from 'styles/layout.module.scss'
import local from 'styles/components/header/calendar.module.scss'

export default (props) => {
	const {
		iconSize=35
	} = props
	const [calendarModal, setCalendarModal] = useState(false)

  return (
		<>
			<div 
				style={{
					width: iconSize,
					height: iconSize
				}}
				onClick={()=> setCalendarModal(true)}
				className={local.calendar_icon}
			>
				<Image 
					src="/images/icons/calendar-thin.svg"
					alt="calendar icon"
					height={iconSize}
					width={iconSize}
				/>
			</div>
			{calendarModal && (
				<div 
					className={cx(local.calendar_modal, layout.f_row, layout.justify_center, layout.align_center)}
					onClick={(e)=> {
						e.preventDefault()
						setCalendarModal(false)
					}}
				>
					<div className={layout.container}>
					<div 
						className={cx(local.close_btn)}
						onClick={(e)=> {
							e.preventDefault()
							setCalendarModal(false)
						}}
					/>
						<iframe 
							style={{border: "solid 1px #777;"}} 
							title="secondary-light Calendar" 
							src="https://calendar.google.com/calendar/embed?src=c_5jsad6k7nn2klsj3ccsdv5eitc%40group.calendar.google.com&amp;ctz=America%2FNew_York" 
							frameborder="0"
						></iframe>
					</div>
				</div>
			)}
		</>
	)
}
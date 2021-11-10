import { useState, useEffect } from 'react'
import cx from 'classnames'

import local from 'styles/components/modal.module.scss'
import layout from 'styles/layout.module.scss'

export default (props) => {
	const {
		className,
		width,
		height,
		open=false,
		closeFunction=()=>null,
		children
	} = props
	const [currentOpen, setCurrentOpen] = useState(open)
	const setOpenState = () => {
		setCurrentOpen(false)
		closeFunction()
	}
	
	useEffect(()=> {
		setCurrentOpen(open)
	}, [open])

	return (
		<div
			className={cx(
				local.modal_outer,
				layout.f_row,
				layout.justify_center,
				layout.align_center,
				{ [local.modal_open]: currentOpen}
			)}
			onClick={setOpenState}
		>
			<div
				className={cx(local.modal_inner, layout.f_col, layout.justify_center, layout.align_center, layout.text_center)}
				onClick={(e) => e.stopPropagation()}
			>
				<div className={local.close_btn} onClick={setOpenState} />
				{children}
			</div>
		</div>
	)
}

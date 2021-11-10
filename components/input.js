import {useState, useEffect, useRef} from 'react'
import cx from 'classnames'
import styles from 'styles/components/input.module.scss'

export default (props) => {
	const {
		onClick,
		onChange,
		lable,
		width,
		type='basic',
		required,
		className,
		value,
		placeholder
	} = props

  return (
		<>
			{lable && <lable>{lable}</lable>}
			<input 
				className={cx(className, styles[type])}
				required={required}
				width={width} 
				value={value} 
				placeholder={placeholder}
				onClick={(e)=> onClick(e)} 
				onChange={(e)=> onChange(e)}
			/>
		</>
	)

}

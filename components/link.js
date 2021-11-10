import {useState, useEffect, useRef} from 'react'
import cx from 'classnames'
import Link from 'next/link'


export default (props) => {
	const {
		href='',
		external=false,
		className,
		children
	} = props

  return (
    <Link 
			href={`${external ? '/api/external/' : ''}${href}`}
			className={className}
		>
			{children}
    </Link>
  ) 
}

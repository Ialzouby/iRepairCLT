import { useState, useEffect, useRef } from 'react'
import cx from 'classnames'
import { useRouter } from 'next/router'
import local from 'styles/components/image.module.scss'

export default (props) => {
	const {
		className,
		alt,
		src,
		width=false,
		height=false,
		layout="fit",
		onLoad = () => null,
		onError = () => null,
		onClick = () => null,
		style={},
	} = props
	const router = useRouter()
	const [currentPath, setCurrentPath] = useState(false)
	const imgRef = useRef(null)
	const loaded = () => {
		imgRef.current && (imgRef.current.classList.add(local.loaded))
		onLoad()
	}

	useEffect(()=> currentPath === router.pathname ? loaded() : setCurrentPath(router.pathname))
	const dimensions = (width || height) ? `?nf_resize=${(layout === "fill" && width && height) ? 'smartcrop' : 'fit'}${width ? '&w=' + width : ''}${height ? '&h=' + height : ''}` : ''
  return (
		<img 
			className={cx(className, local.image, {[local.fill]: layout === "fill"})}
			alt={alt}
			src={`${src}${dimensions}`}
			width={width} 
			height={height}
			ref={imgRef}
			onClick={(e)=> onClick(e)}
			onLoad={()=> loaded()}
			onError={(e)=> onError(e)}
			style={style && style}
		/>
  )
}

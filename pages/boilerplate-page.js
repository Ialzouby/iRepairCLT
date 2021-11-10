import {useState, useEffect, useRef} from 'react'
import cx from 'classnames'

import layout from '../styles/layout.module.scss'
import global from '../styles/global.module.scss'

export default () => {
  const [width, setWidth] = useState(0)
  const animatedText = []
  useEffect(()=> animatedText.map((i)=> i.classList.add(global.animate_in_end)))
  useEffect(() => {
    const w = () => setWidth(window.innerWidth)
    w()
    window.addEventListener('resize', w)
    return () => window.removeEventListener('resize', w)
	}, [width])
	

  return (
    <>
      
    </>
  )
}

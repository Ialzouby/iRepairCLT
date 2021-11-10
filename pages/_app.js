import {useState, useEffect, useRef} from 'react'

import Header from 'sections/header.js'
import Footer from 'sections/footer.js'

import 'styles/_appDefault.scss'

function MyApp({ Component, pageProps }) {
  const [width, setWidth] = useState(0)
  useEffect(() => {
    const w = () => setWidth(window.innerWidth)
    w()
    window.addEventListener('resize', w)
    return () => window.removeEventListener('resize', w)
	}, [width])

  return (
    <>
      {/* <Header width={width} /> */}
      <Component {...pageProps} width={width} />
      <Footer />
    </>
  )
}

export default MyApp

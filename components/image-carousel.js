import { useState, useEffect, useRef } from 'react'
import cx from 'classnames'
import Slider from "react-slick"

import Image from 'components/image'
import Button from 'components/button'
import Modal from 'components/modal'

import local from 'styles/components/image-carousel.module.scss'
import layout from 'styles/layout.module.scss'
import global from 'styles/global.module.scss'

import 'slick-carousel/slick/slick.css'
import 'slick-carousel/slick/slick-theme.css'

export default (props) => {
	const {
		images=false,
		width=0
	} = props
	const [modalContent, setModalContent] = useState(false)
	const settings = {
		infinight: true,
		dots: false,
		speed: 500,
		slidesToShow: Math.floor(width / 240),
		slidesToScroll: 1
	}
	return (
		<>
			<div className={cx("image-carousel", local.carousel_container)}>
				<Slider {...settings}>
					{images && images.map((img, i) => {
						return (
							<div>
								<div
									className={local.carousel_image}
									onClick={() => setModalContent(img)}
								>
									<Image
										src={`/images/${img}`}
										alt={`Carousel Image ${i + 1}`}
										height={300}
										width={300}
									/>
								</div>
							</div>
						)
					})}
				</Slider>
			</div>
			<Modal open={modalContent} closeFunction={()=> setModalContent(false)}>
				<Image
					src={`/images/${modalContent}`}
					alt={`Carousel Image ${modalContent}`}
					className={local.modal_image}
					height={800}
					width={width < 1100 ? width : 1100}
				/>
			</Modal>
    </>
  )
}

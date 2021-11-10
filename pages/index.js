import { useState, useEffect, useRef } from 'react'
import cx from 'classnames'
import Head from 'next/head'
import Link from 'components/link'


import Card from 'components/card'
import Image from 'components/image'
import Button from 'components/button'
import HoursOfOperation from 'components/hoursOfOperation'
import Tab from 'components/tab'

import layout from 'styles/layout.module.scss'
import global from 'styles/global.module.scss'
import local from 'styles/pages/home.module.scss'

export default (props) => {
  const { width } = props

  return (
    <>
      <div className={cx(layout.container, layout.w100_percent, layout.justify_between, layout.text_center, layout.align_stretch, layout.f_row, layout.f_wrap, layout.f_col_mob)}>
        <div className={cx(layout.block_12_mob, layout.block_6, global.text_white, layout.text_left, local.header)}>
          <h1>
            iRepair <br />
            Charlotte
          </h1>
          <h3>Your friendly neighborhood nerds</h3>
        </div>
        <div className={cx(layout.block_12_mob, layout.block_6)}>
          <Image
            src="images/undraw/undraw_clean_up_ucm0.svg"
            className={cx(layout.w100_percent)}
          />
        </div>
        <div className={cx(layout.block_12_mob, layout.block_4)}>
          <Card
            type="secondary"
            link="#"
            className={local.complementary}
          >
            <div>
              <h3>Repairs</h3>
              <p>Computer, phone, tablet, and game console repair</p>
            </div>
            <Button
              basic={true}
              type="white"
              href="#"
            >
              More Info
            </Button>
          </Card>
        </div>
        <div className={cx(layout.block_12_mob, layout.block_4)}>
          <Card
            type="secondary"
            link="#"
            className={local.treehouses}
          >
            <div>
              <h3>Drones</h3>
              <p>Drone flight footage, upgrades, and repairs</p>
            </div>
            <Button
              basic={true}
              type="white"
              href="#"
            >
              More Info
            </Button>
          </Card>
        </div>
        <div className={cx(layout.block_12_mob, layout.block_4)}>
          <Card
            type="secondary"
            link="#"
            className={local.wine_club}
          >
            <div>
              <h3>Parnerships</h3>
              <p>About partnering with iRepair Charlotte</p>
            </div>
            <Button
              href="#"
              type="white"
              basic={true}
            >
              More Info
            </Button>
          </Card>
        </div>
      </div>

    </>
  )
}

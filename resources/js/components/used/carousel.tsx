// FadeSwiper.jsx
import React from 'react';
import { Swiper, SwiperSlide } from 'swiper/react';
import { EffectFade, Autoplay} from 'swiper/modules';
import bg1 from '../../../assets/background/Background_Stembayo.webp';
import bg2 from '../../../assets/background/Background_Stembayo2.webp';
import bg3 from '../../../assets/background/Background_Stembayo3.webp';

import 'swiper/css';
import 'swiper/css/effect-fade';
import 'swiper/css/pagination';

const FadeSwiper = () => {
  return (
    <div className="absolute inset-0">
      <Swiper
        effect="fade"
        modules={[EffectFade, Autoplay]}
        loop={true}
        speed={5000}
        autoplay={{
          delay: 3000,
          disableOnInteraction: true,
        }}
        fadeEffect={{
          crossFade: true,
        }}
        allowTouchMove={false} 
        pagination={{
          clickable: false,
        }}
        className="w-full h-full"
      >
        <SwiperSlide>
          <img
            src={bg1}
            alt=""
            draggable="false"
            className="w-full h-full object-cover opacity-40 saturate-130 brightness-105 contrast-105 scale-x-[-1] object-center"
          />
        </SwiperSlide>
        <SwiperSlide>
          <img
            src={bg2}
            alt=""
            draggable="false"
            className="w-full h-full object-cover opacity-40 saturate-130 brightness-105 contrast-105 scale-x-[-1] object-center"
          />
        </SwiperSlide>
        <SwiperSlide>
          <img
            src={bg3}
            alt=""
            draggable="false"
            className="w-full h-full object-cover opacity-40 saturate-130 brightness-105 contrast-105 scale-x-[-1] object-center"
          />
        </SwiperSlide>
      </Swiper>
    </div>
  );
};

export default FadeSwiper;
